<?php

namespace App\Service;

use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatch;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Entity\Subscriptions\Applicant\Lamatch\CompanyEntityResult;
use App\Repository\CompanyRepositories\CompanyEntityRepository;
use App\Repository\ExpertiseFieldRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantLamatchRepository;
use App\Repository\SubscriptionRepositories\Applicant\CompanyEntityResultRepository;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;

class ApplicantLamatchService
{
    public function __construct(
        private CompanyEntityRepository $companyEntityRepository,
        private WorkforceRepository $workforceRepository,
        private ExpertiseFieldRepository $expertiseFieldRepository,
        private EmployerLamatchProfileRepository $employerLamatchProfileRepository,
        private CompanyEntityResultRepository $companyEntityResultRepository,
        private ApplicantLamatchRepository $applicantLamatchRepository,
    ) {
    }

    public function getCompanyResults(
        ApplicantLamatchSubscription $applicantLamatchSubscription,
        ApplicantLamatch $applicantLamatch
    ): ArrayCollection {
        $applicantLamatchProfile = $applicantLamatchSubscription->getApplicantLamatchProfile();
        $companyEntities = $this->companyEntityRepository->findAll();
        $companyResults = new ArrayCollection();
        $matchResults = [];

        foreach ($companyEntities as $companyEntity) {
            //Matching avec Workforce
            $companyWorkforceId = $companyEntity->getProfile()->getWorkforce();
            $applicantWorkforceId = $applicantLamatchProfile->getDesiredWorkforce();
            $workforceMatch = $this->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);
            $matchResults['workforce'] = $workforceMatch;

            //Matching avec ExpertiseFields
            $companyExpertiseFields = ($companyEntity->getProfile()->getExpertiseFields());
            $applicantExpertiseFields = $applicantLamatchProfile->getDesiredExpertiseFields();
            $expertiseFieldsMatch = $this->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);
            $matchResults['expertiseField'] = $expertiseFieldsMatch;

            //Matching avec Tools
            $companyTools = $companyEntity->getProfile()->getTools();
            $applicantTools = $applicantLamatchProfile->getTools();
            $toolsMatch = $this->getToolsMatch($companyTools, $applicantTools);
            $matchResults['tool'] = $toolsMatch;

            //Matching avec Badges
            $companyBadges = $companyEntity->getProfile()->getBadges();
            $applicantBadges = $applicantLamatchProfile->getDesiredBadges();
            $badgesMatch = $this->getBadgesMatch($companyBadges, $applicantBadges);
            $matchResults['badge'] = $badgesMatch;

            //Matching avec JobTitle
            $companyJobTypes = $companyEntity->getProfile()->getJobTypes();
            $applicantJobTypes = $applicantLamatchProfile->getJobTitle()->getJobTypes();
            $jobTitleMatch = $this->getJobTitleMatch($companyJobTypes, $applicantJobTypes);
            $matchResults['jobTitle'] = $jobTitleMatch;

            //Matching avec Location
            $applicantLocation = $applicantLamatchProfile->getDesiredLocation();
            $companyEntitiesOffices = $companyEntity->getCompanyEntityOffices();
            $companyEntityCities = new ArrayCollection();

            foreach ($companyEntitiesOffices as $companyEntitiesOffice) {
                $companyEntityCities->add($companyEntitiesOffice->getAddress()->getCityObject());
            }

            $locationMatch = $this->getLocationMatch($companyEntityCities, $applicantLocation);
            $matchResults['location'] = $locationMatch;

            $matchingpercentage = $this->getMatchingPercentage($matchResults);

            $this->applicantLamatchRepository->add($applicantLamatch, true);

            $companyEntityResult = new CompanyEntityResult();
            $companyEntityResult->setCompanyEntity($companyEntity);
            $companyEntityResult->setMatchingPercentage($matchingpercentage);
            $companyEntityResult->setApplicantLamatch($applicantLamatch);

            $this->companyEntityResultRepository->add($companyEntityResult, true);
            $companyResults->add($companyEntityResult);

            //Matching avec DISCPersonalities
            // $applicantQualities = $applicantLamatchProfile->getQualities();
            // $employerLamatchProfiles =
            //     $this->employerLamatchProfileRepository->findAllEmployerLamatchProfilesByCompanyProfile(
            //         $companyEntity->getProfile()->getId()
            //     );

            // $personalitiesResearchByCompany = new ArrayCollection();

            // foreach ($employerLamatchProfiles as $employerLamatchProfile) {
            //     $personalitiesResearchByCompany->add($employerLamatchProfile->getPersonnality());
            // }

            // $applicantPersonalityPercentages = DISCPersonality::getPersonalityPercentagesByQualities(
            //     $applicantQualities
            // );
            // $companyPersonalityPercentages = DISCPersonality::getPersonalityPercentagesByPersonalities(
            //     $personalitiesResearchByCompany
            // );
            // $qualitiesMatch = $this->getPersonalitiesMatch(
            //     $companyPersonalityPercentages,
            //     $applicantPersonalityPercentages
            // );
        }

        return $companyResults;
    }

    public function getMatchingPercentage($matchResults): int
    {
        $matchingPercentage = 0;
        $matchingPercentage += $matchResults['workforce'];
        $matchingPercentage += $matchResults['expertiseField'];
        $matchingPercentage += $matchResults['tool'];
        $matchingPercentage += $matchResults['badge'];
        $matchingPercentage += $matchResults['jobTitle'];
        $matchingPercentage += $matchResults['location'];

        $matchingPercentage = (int) ($matchingPercentage / 6);

        return $matchingPercentage;
    }

    public function getLocationMatch($companyEntityCities, $applicantLocation): int
    {
        $cityMatch = 0;
        $departmentMatch = 0;
        $applicantDesiredCities = $applicantLocation->getDesiredCities();
        $numberOfapplicantDesiredCities = count($applicantDesiredCities);
        $applicantDesiredDepartments = $applicantLocation->getDesiredDepartments();
        $numberOfapplicantDesiredDepartments = count($applicantDesiredDepartments);
        $companyEntityDepartments = new ArrayCollection();

        foreach ($companyEntityCities as $companyEntityCity) {
            if (!$companyEntityDepartments->contains($companyEntityCity->getDepartment())) {
                $companyEntityDepartments->add($companyEntityCity->getDepartment());
            }
        }

        foreach ($companyEntityCities as $companyEntityCity) {
            if ($applicantDesiredCities->contains($companyEntityCity)) {
                $cityMatch += 1;
            }
        }

        foreach ($companyEntityDepartments as $companyEntityDepartment) {
            if ($applicantDesiredDepartments->contains($companyEntityDepartment)) {
                $departmentMatch += 1;
            }
        }

        if ($numberOfapplicantDesiredCities > 0) {
            $cityMatch = $cityMatch * 100 / $numberOfapplicantDesiredCities;
        }

        if ($numberOfapplicantDesiredDepartments > 0) {
            $departmentMatch = $departmentMatch * 100 / $numberOfapplicantDesiredDepartments;
        }

        return ($cityMatch + $departmentMatch) / 2;
    }

    // public function getPersonalitiesMatch(
    //     array $companyPersonalityPercentages,
    //     array $applicantPersonalityPercentages
    // ) {
    //     $personalitiesMatch = 0;
    //     dd($companyPersonalityPercentages, $applicantPersonalityPercentages);
    //     foreach ($companyPersonalityPercentages as $companyPersonality => $companyPersonalityPercentage) {

    //         foreach ($applicantPersonalityPercentages as $applicantPersonality => $applicantPersonalityPercentage) {

    //             if ($applicantPersonality === $companyPersonality) {
    //                 $personalitiesMatch += $companyPersonalityPercentage + $applicantPersonalityPercentage;
    //             }
    //         }
    //     }
    //    dd($personalitiesMatch);
    //     return $personalitiesMatch;
    // }



    public function getJobTitleMatch($companyJobTypes, $applicantJobTypes)
    {
        $jobTitleMatch = 100;

        if (!$applicantJobTypes) {
            return 0;
        }

        foreach ($companyJobTypes as $companyJobType) {
            if ($applicantJobTypes->contains($companyJobType)) {
                return $jobTitleMatch;
            }
        }

        return 0;
    }

    public function getBadgesMatch($companyBadges, $applicantBadges)
    {
        if ($applicantBadges->isEmpty() || $applicantBadges === null) {
            return 100;
        }

        $badgesMatch = 0;
        foreach ($applicantBadges as $applicantBadge) {
            foreach ($companyBadges as $companyBadge) {
                if ($applicantBadge->getId() === $companyBadge->getId()) {
                    $badgesMatch++;
                }
            }
        }
        $badgesMatch = $badgesMatch * 100 / count($applicantBadges);

        return (int)$badgesMatch;
    }

    public function getToolsMatch($companyTools, $applicantTools)
    {
        $toolsMatch = 0;
        foreach ($companyTools as $companyTool) {
            foreach ($applicantTools as $applicantTool) {
                if ($companyTool->getId() === $applicantTool->getId()) {
                    $toolsMatch++;
                }
            }
        }

        $toolsMatch = $toolsMatch * 100 / count($companyTools);

        return (int)$toolsMatch;
    }

    public function getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields)
    {
        $expertiseFieldsMatch = 100;

        if ($applicantExpertiseFields === null || $applicantExpertiseFields->isEmpty()) {
            return $expertiseFieldsMatch;
        }


        foreach ($applicantExpertiseFields as $applicantExpertiseField) {
            foreach ($companyExpertiseFields as $companyExpertiseField) {
                if ($applicantExpertiseField->getId() === $companyExpertiseField->getId()) {
                    return $expertiseFieldsMatch;
                }
            }
        }

        return 0;
    }

    public function getWorkforceMatch(string $companyWorkforceId, ?string $applicantWorkforceId): int
    {
        $workforceMatch = 100;
        $companyWorkforceLevel = $this->workforceRepository->find($companyWorkforceId)->getLevel();

        if ($applicantWorkforceId !== null) {
            $applicantWorkforceLevel = $this->workforceRepository->find($applicantWorkforceId)->getLevel();
        } else {
            return $workforceMatch;
        }

        $workforcesArray = [$applicantWorkforceLevel, $companyWorkforceLevel];
        rsort($workforcesArray);

        $diffBetweenWorkforces = $workforcesArray[0] - $workforcesArray[1];

        if ($diffBetweenWorkforces > 0 && $diffBetweenWorkforces <= 2) {
            $workforceMatch = 75;
        }
        if ($diffBetweenWorkforces > 2 && $diffBetweenWorkforces <= 4) {
            $workforceMatch = 50;
        }
        if ($diffBetweenWorkforces > 4 && $diffBetweenWorkforces <= 10) {
            $workforceMatch = 25;
        }

        return $workforceMatch;
    }
}
