<?php

namespace App\Repository;

use App\Entity\Repositories\OfferStatus;
use App\Utils\Utils;

class OfferStatusRepository 
{
    /**
     * Undocumented function
     *
     * @return OfferStatus[]
     */
    public function findAll():array
    {
        $statuses = [];
        $arrayStatuses = OfferStatus::STATUSES;
        if(is_array($arrayStatuses) && !empty($arrayStatuses)){
            foreach ($arrayStatuses as $status) {
                $statuses[] = new OfferStatus(Utils::getArrayValue('slug', $status), Utils::getArrayValue('label', $status));
            }
            return $statuses;
        }
        return null;
    }
}