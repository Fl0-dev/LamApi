<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\ApplicationStatus;
use App\Utils\Utils;

class ApplicationStatusRepository
{

    /**
     * @return ApplicantStatus[]
     */
    public function findAll(): array
    {
        $applicantStatuses = [];
        $arrayApplicantStatuses = ApplicationStatus::APPLICATION_STATUSES;

        foreach ($arrayApplicantStatuses as $applicantStatus) {
            $applicantStatuses[] = new ApplicationStatus(Utils::getArrayValue('slug', $applicantStatus), Utils::getArrayValue('label', $applicantStatus));
        }

        return $applicantStatuses;
    }
}
