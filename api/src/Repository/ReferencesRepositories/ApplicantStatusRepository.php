<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\ApplicantStatus;
use App\Utils\Utils;

class ApplicantStatusRepository
{

    /**
     * @return ApplicantStatus[]
     */
    public function findAll(): array
    {
        $applicantStatuses = [];
        $arrayApplicantStatuses = ApplicantStatus::APPLICANT_STATUSES;

        foreach ($arrayApplicantStatuses as $applicantStatus) {
            $applicantStatuses[] = new ApplicantStatus(Utils::getArrayValue('slug', $applicantStatus), Utils::getArrayValue('label', $applicantStatus));
        }

        return $applicantStatuses;
    }
}
