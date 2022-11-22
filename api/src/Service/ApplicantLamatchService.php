<?php

namespace App\Service;

use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Repository\CompanyRepositories\CompanyEntityRepository;
use App\Repository\ExpertiseFieldRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;

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
        }


        //Matching avec Badges
        //Matching avec JobTitles
        //Matching avec Localisation
        //Matching avec DISCQualities
        dd($companyEntities);
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
                    return $expertiseFieldsMatch ;
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
