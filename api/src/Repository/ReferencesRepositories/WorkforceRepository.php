<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\Workforce;
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
                    Utils::getArrayValue('label', $workforce)
                );
            }
        }

        return $workforces;
    }

    public function findByKeywords(string $keywords): ?array
    {
        $workforces = $this->findAll();
        $results = [];

        if (is_array($workforces) && !empty($workforces)) {

            foreach ($workforces as $workforce) {
                if (strpos($workforce->getSlug(), $keywords) !== false) {
                    $results[] = $workforce;
                }
            }
        }

        return $results;
    }
}