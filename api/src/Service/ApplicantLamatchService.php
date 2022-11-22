<?php

namespace App\Service;

use App\Entity\References\Workforce;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Repository\CompanyRepositories\CompanyEntityRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;

class ApplicantLamatchService
{
    public function __construct(
        private CompanyEntityRepository $companyEntityRepository,
        private WorkforceRepository $workforceRepository,
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
        }

        //Matching avec ExpertiseFields
        //Matching avec Tools
        //Matching avec Badges
        //Matching avec JobTitles
        //Matching avec Localisation
        //Matching avec DISCQualities
        dd($companyEntities);
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
