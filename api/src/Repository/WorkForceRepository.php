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

    public function findByKeywords(string $keywords): array
    {
        $workforces = $this->findAll();
        $results = [];
        if (is_array($workforces) && !empty($workforces)) {
            foreach ($workforces as $workforce) {
                if (strpos($workforce->getLabel(), $keywords) !== false || strpos($workforce->getSlug(), $keywords) !== false) {
                    $results[] = $workforce;
                }
            }

            return $results;
        }

        return null;
    }
}
