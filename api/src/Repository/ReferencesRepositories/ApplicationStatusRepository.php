<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\ApplicationStatus;
use App\Utils\Utils;

class ApplicationStatusRepository
{

    /**
     * Undocumented function
     *
     * @return ApplicantStatus[]
     */
    public function findAll(): array
    {
        $applicantStatuses = [];
        $arrayApplicantStatuses = ApplicationStatus::APPLICATION_STATUSES;
        if (is_array($arrayApplicantStatuses) && !empty($arrayApplicantStatuses)) {
            foreach ($arrayApplicantStatuses as $applicantStatus) {
                $applicantStatuses[] = new ApplicationStatus(Utils::getArrayValue('slug', $applicantStatus), Utils::getArrayValue('label', $applicantStatus));
            }
            return $applicantStatuses;
        }
        return null;
    }
}
