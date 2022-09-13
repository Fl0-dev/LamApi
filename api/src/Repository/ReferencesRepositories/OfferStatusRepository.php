<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\OfferStatus;
use App\Utils\Utils;

class OfferStatusRepository
{
    /**
     * @return OfferStatus[]
     */
    public function findAll(): array
    {
        $statuses = [];
        $arrayStatuses = OfferStatus::STATUSES;
        
        if (is_array($arrayStatuses) && !empty($arrayStatuses)) {

            foreach ($arrayStatuses as $status) {
                $statuses[] = new OfferStatus(Utils::getArrayValue('slug', $status), Utils::getArrayValue('label', $status));
            }
        }

        return $statuses;
    }
}
