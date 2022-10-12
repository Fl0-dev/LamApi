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

        if (is_array($arrayApplicantStatuses)) {
            foreach ($arrayApplicantStatuses as $applicantStatus) {
                $applicantStatuses[] = new ApplicationStatus(
                    Utils::getArrayValue('slug', $applicantStatus),
                    Utils::getArrayValue('label', $applicantStatus)
                );
            }
        }

        return $applicantStatuses;
    }

    public function find(string $id): ?ApplicationStatus
    {
        $applicantStatuses = $this->findAll();

        foreach ($applicantStatuses as $applicantStatus) {
            if ($applicantStatus->getId() === $id) {
                return $applicantStatus;
            }
        }

        return null;
    }
}
