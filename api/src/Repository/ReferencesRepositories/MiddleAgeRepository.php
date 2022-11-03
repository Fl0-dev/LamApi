<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\MiddleAge;
use App\Utils\Utils;

class MiddleAgeRepository
{
    /**
     * @return MiddleAge[]
     */
    public function findAll(): array
    {
        $middleAges = [];
        $arrayMiddleAges = MiddleAge::MIDDLE_AGES;

        if (is_array($arrayMiddleAges)) {
            foreach ($arrayMiddleAges as $middleAge) {
                $middleAges[] = new MiddleAge(
                    Utils::getArrayValue('slug', $middleAge),
                    Utils::getArrayValue('label', $middleAge)
                );
            }
        }

        return $middleAges;
    }

    public function find(?string $id): ?MiddleAge
    {
        $middleAges = $this->findAll();

        foreach ($middleAges as $middleAge) {
            if ($middleAge->getId() === $id) {
                return $middleAge;
            }
        }

        return null;
    }
}
