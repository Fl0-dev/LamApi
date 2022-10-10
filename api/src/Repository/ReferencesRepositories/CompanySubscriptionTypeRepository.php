<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\CompanySubscriptionType;
use App\Utils\Utils;

class CompanySubscriptionTypeRepository 
{
    /**
     * @return CompanySubscriptionType[]
     */
    public function findAll(): array
    {
        $companySubscriptionTypes = [];
        $arrayCompanySubscriptionTypes = CompanySubscriptionType::COMPANY_SUBSCRIPTION_TYPES;

        if (is_array($arrayCompanySubscriptionTypes)) {

            foreach ($arrayCompanySubscriptionTypes as $companySubscriptionType) {
                $companySubscriptionTypes[] = new CompanySubscriptionType(
                    Utils::getArrayValue('slug', $companySubscriptionType),
                    Utils::getArrayValue('label', $companySubscriptionType)
                );
            }
        }

        return $companySubscriptionTypes;
    }

    public function find(string $id): ?CompanySubscriptionType
    {
        $companySubscriptionTypes = $this->findAll();

        foreach ($companySubscriptionTypes as $companySubscriptionType) {
            if ($companySubscriptionType->getId() === $id) {
                return $companySubscriptionType;
            }
        }

        return null;
    }
}