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
        private MatchingService $matchingService,
    ) {
    }

    public function getCompanyResults(
        ApplicantLamatchSubscription $applicantLamatchSubscription,
        ApplicantLamatch $applicantLamatch
    ): array {
        $applicantLamatchProfile = $applicantLamatchSubscription->getApplicantLamatchProfile();
        $companyEntities = $this->companyEntityRepository->findAll();
        $companyResults = new ArrayCollection();
        $matchResults = [];

        foreach ($companyEntities as $companyEntity) {
            //Matching with Workforce
            $companyWorkforceId = $companyEntity->getProfile()->getWorkforce();
            $applicantWorkforceId = $applicantLamatchProfile->getDesiredWorkforce();
            $workforceMatch =
                $this->matchingService->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);
            $matchResults['workforce'] = $workforceMatch;

            //Matching with ExpertiseFields
            $companyExpertiseFields = ($companyEntity->getProfile()->getExpertiseFields());
            $applicantExpertiseFields = $applicantLamatchProfile->getDesiredExpertiseFields();
            $expertiseFieldsMatch =
                $this->matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);
            $matchResults['expertiseField'] = $expertiseFieldsMatch;

            //Matching with Tools
            $companyTools = $companyEntity->getProfile()->getTools();
            $applicantTools = $applicantLamatchProfile->getTools();
            $toolsMatch = $this->matchingService->getToolsMatch($companyTools, $applicantTools);
            $matchResults['tool'] = $toolsMatch;

            //Matching with Badges
            $companyBadges = $companyEntity->getProfile()->getBadges();
            $applicantBadges = $applicantLamatchProfile->getDesiredBadges();
            $badgesMatch = $this->matchingService->getBadgesMatch($companyBadges, $applicantBadges);
            $matchResults['badge'] = $badgesMatch;

            //Matching with JobTypes
            $companyJobTypes = $companyEntity->getProfile()->getJobTypes();
            $applicantJobTypes = $applicantLamatchProfile->getJobTitle()->getJobTypes();
            $jobTitleMatch = $this->matchingService->getJobTypeMatch($companyJobTypes, $applicantJobTypes);
            $matchResults['jobTitle'] = $jobTitleMatch;

            //Matching with Location
            $applicantLocation = $applicantLamatchProfile->getDesiredLocation();
            $companyEntitiesOffices = $companyEntity->getCompanyEntityOffices();
            $companyEntityCities = new ArrayCollection();

            foreach ($companyEntitiesOffices as $companyEntitiesOffice) {
                $companyEntityCities->add($companyEntitiesOffice->getAddress()->getCityObject());
            }

            $locationMatch = $this->matchingService->getLocationMatch($companyEntityCities, $applicantLocation, 'applicant');
            $matchResults['location'] = $locationMatch;

            $matchingPercentage = $this->matchingService->getMatchingPercentage($matchResults);

            $this->applicantLamatchRepository->add($applicantLamatch, true);

            $companyEntityResult = new CompanyEntityResult();
            $companyEntityResult->setCompanyEntity($companyEntity);
            $companyEntityResult->setMatchingPercentage($matchingPercentage);
            $companyEntityResult->setApplicantLamatch($applicantLamatch);

            $this->companyEntityResultRepository->add($companyEntityResult, true);
            $companyResults->add($companyEntityResult);
        }

        $companyResults = $this->getCompanyEntityResultsForDisplay($companyResults);

        return $companyResults;
    }

    public function getCompanyEntityResultsForDisplay(ArrayCollection $companyEntityResults): array
    {
        $companyEntityResultsForDisplay = [];

        foreach ($companyEntityResults as $companyEntityResult) {
            $companyEntityResultsForDisplay[] = [
                'companyEntity' => [
                    'id' => $companyEntityResult->getCompanyEntity()->getId(),
                    'name' => $companyEntityResult->getCompanyEntity()->getName(),
                    'logo' => $companyEntityResult->getCompanyEntity()->getCompanyGroup()->getLogo()->getFilePath(),
                    'workforce' => $companyEntityResult->getCompanyEntity()->getProfile()->getWorkforceLabel(),
                    'departments' => $companyEntityResult->getCompanyEntity()->getAllLabelDepartments(),
                    'badges' => $companyEntityResult->getCompanyEntity()->getProfile()->getAllLabelBadges(),
                ],
                'matchingPercentage' => $companyEntityResult->getMatchingPercentage(),
            ];
        }

        usort($companyEntityResultsForDisplay, function ($a, $b) {
            return $b['matchingPercentage'] <=> $a['matchingPercentage'];
        });

        return $companyEntityResultsForDisplay;
    }
}
