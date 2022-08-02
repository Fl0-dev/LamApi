<?php

namespace App\Repository;

use App\Entity\Repositories\Workforce;
use App\Utils\Utils;

class WorkforceRepository
{
    /**
     * Undocumented function
     *
     * @return Workforce[]
     */
    public function findAll(): array
    {
        $workforces = [];
        $arrayWorkforces = Workforce::WORKFORCES;
        if (is_array($arrayWorkforces) && !empty($arrayWorkforces)) {
            foreach ($arrayWorkforces as $value => $workforce) {
                $workforces[] = new Workforce(
                    $value, 
                    Utils::getArrayValue('slug', $workforce),
                    Utils::getArrayValue('label', $workforce));
            }
            return $workforces;
        }
        return null;
    }
}
