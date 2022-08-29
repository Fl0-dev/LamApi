<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\ApplicantStatus;
use App\Utils\Utils;

class ApplicantStatusRepository
{

    /**
     * Undocumented function
     *
     * @return ApplicantStatus[]
     */
    public function findAll(): array
    {
        $applicantStatuses = [];
        $arrayApplicantStatuses = ApplicantStatus::APPLICANT_STATUSES;
        if (is_array($arrayApplicantStatuses) && !empty($arrayApplicantStatuses)) {
            foreach ($arrayApplicantStatuses as $applicantStatus) {
                $applicantStatuses[] = new ApplicantStatus(Utils::getArrayValue('slug', $applicantStatus), Utils::getArrayValue('label', $applicantStatus));
            }
            return $applicantStatuses;
        }
        return null;
    }
}
