<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\AbstractUserType;
use App\Utils\Utils;

class AbstractUserTypeRepository
{
    /**
     * @return AbstractUserType[]
     */
    public function findAll(): array
    {
        $abstractUserTypes = [];
        $arrayAbstractUserTypes = AbstractUserType::USER_TYPES;

        if (is_array($arrayAbstractUserTypes)) {
            foreach ($arrayAbstractUserTypes as $abstractUserType) {
                $abstractUserTypes[] = new AbstractUserType(
                    Utils::getArrayValue('slug', $abstractUserType),
                    Utils::getArrayValue('label', $abstractUserType)
                );
            }
        }

        return $abstractUserTypes;
    }

    public function find(?string $id): ?AbstractUserType
    {
        $abstractUserTypes = $this->findAll();

        foreach ($abstractUserTypes as $abstractUserType) {
            if ($abstractUserType->getId() === $id) {
                return $abstractUserType;
            }
        }

        return null;
    }
}
