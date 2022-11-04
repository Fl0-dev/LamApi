<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\CompanyAge;
use App\Utils\Utils;

class CompanyAgeRepository
{
    /**
     * @return CompanyAge[]
     */
    public function findAll(): array
    {
        $companyAges = [];
        $arrayCompanyAges = CompanyAge::COMPANY_AGES;

        if (is_array($arrayCompanyAges)) {
            foreach ($arrayCompanyAges as $companyAge) {
                $companyAges[] = new CompanyAge(
                    Utils::getArrayValue('slug', $companyAge),
                    Utils::getArrayValue('label', $companyAge)
                );
            }
        }

        return $companyAges;
    }

    public function find(?string $id): ?CompanyAge
    {
        $companyAges = $this->findAll();

        foreach ($companyAges as $companyAge) {
            if ($companyAge->getId() === $id) {
                return $companyAge;
            }
        }

        return null;
    }
}
