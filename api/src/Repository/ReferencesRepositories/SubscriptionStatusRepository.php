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
        if (is_array($arrayStatuses)) {
            foreach ($arrayStatuses as $value => $status) {
                $statuses[] = new SubscriptionStatus(
                    Utils::getArrayValue('slug', $status),
                    Utils::getArrayValue('label', $status)
                );
            }
        }

        return $statuses;
    }
}
