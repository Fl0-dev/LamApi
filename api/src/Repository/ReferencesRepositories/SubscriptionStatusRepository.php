<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\SubscriptionStatus;
use App\Utils\Utils;

class SubscriptionStatusRepository
{
    /**
     * @return SubscriptionStatus[]
     */
    public function findAll(): array
    {
        $statuses = [];
        $arrayStatuses = SubscriptionStatus::STATUSES;

        if (is_array($arrayStatuses) && !empty($arrayStatuses)) {

            foreach ($arrayStatuses as $value => $status) {
                $statuses[] = new SubscriptionStatus(
                    $value,
                    Utils::getArrayValue('slug', $status),
                    Utils::getArrayValue('label', $status)
                );
            }
        }

        return $statuses;
    }
}