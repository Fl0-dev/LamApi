<?php

namespace App\Service;

use App\Entity\JobTitle;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Repository\CompanyRepositories\CompanyEntityRepository;
use App\Repository\ExpertiseFieldRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;

class ApplicantLamatchService
{
    public function __construct(
        private CompanyEntityRepository $companyEntityRepository,
        private WorkforceRepository $workforceRepository,
        private ExpertiseFieldRepository $expertiseFieldRepository,
    ) {
    }

    public function getCompanyResults(ApplicantLamatchSubscription $applicantLamatchSubscription)
    {
        $applicantLamatchProfile = $applicantLamatchSubscription->getApplicantLamatchProfile();
        $companyEntities = $this->companyEntityRepository->findAll();
        $CompanyResults = [];

        foreach ($companyEntities as $companyEntity) {
            //Matching avec Workforce
            $companyWorkforceId = $companyEntity->getProfile()->getWorkforce();
            $applicantWorkforceId = $applicantLamatchProfile->getDesiredWorkforce();
            $workforceMatch = $this->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);

            //Matching avec ExpertiseFields
            $companyExpertiseFields = ($companyEntity->getProfile()->getExpertiseFields());

            $applicantExpertiseFields = $applicantLamatchProfile->getDesiredExpertiseFields();
            $expertiseFieldsMatch = $this->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

            //Matching avec Tools
            $companyTools = $companyEntity->getProfile()->getTools();
            $applicantTools = $applicantLamatchProfile->getTools();
            $toolsMatch = $this->getToolsMatch($companyTools, $applicantTools);

            //Matching avec Badges
            $companyBadges = $companyEntity->getProfile()->getBadges();
            $applicantBadges = $applicantLamatchProfile->getDesiredBadges();
            $badgesMatch = $this->getBadgesMatch($companyBadges, $applicantBadges);

            //Matching avec JobTitle
            $companyJobTypes = $companyEntity->getProfile()->getJobTypes();
            $applicantJobTypes = $applicantLamatchProfile->getJobTitle()->getJobTypes();
            $jobTitleMatch = $this->getJobTitleMatch($companyJobTypes, $applicantJobTypes);

            //Matching avec DISCPersonalities
            $applicantQualities = $applicantLamatchProfile->getQualities();
            $employerLamatchProfiles =
                $this->employerLamatchProfileRepository->findAllEmployerLamatchProfilesByCompanyProfile(
                    $companyEntity->getProfile()->getId()
                );

            $personalitiesResearchByCompany = new ArrayCollection();

            foreach ($employerLamatchProfiles as $employerLamatchProfile) {
                $personalitiesResearchByCompany->add($employerLamatchProfile->getPersonnality());
            }

            $applicantPersonalities = DISCPersonality::getLeadingPersonalitiesByQualities($applicantQualities);
            $qualitiesMatch = $this->getPersonalitiesMatch($personalitiesResearchByCompany, $applicantPersonalities);

            //Matching avec Localisation
        }

        dd($companyEntities);
    }

    public function getPersonalitiesMatch($personalitiesResearchByCompany, $applicantQualities)
    {
    }

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
