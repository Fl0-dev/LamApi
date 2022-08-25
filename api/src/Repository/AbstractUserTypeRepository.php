<?php

namespace App\Repository;

use App\Entity\Repositories\AbstractUserType;
use App\Utils\Utils;

class AbstractUserTypeRepository
{

    /**
     * Undocumented function
     *
     * @return AbstractUserType[]
     */
    public function findAll(): array
    {
        $abstractUserTypes = [];
        $arrayAbstractUserTypes = AbstractUserType::USER_TYPES;

        if (is_array($arrayAbstractUserTypes) && !empty($arrayAbstractUserTypes)) {
            foreach ($arrayAbstractUserTypes as $abstractUserType) {
                $abstractUserTypes[] = new AbstractUserType(Utils::getArrayValue('slug', $abstractUserType), Utils::getArrayValue('label', $abstractUserType));
            }
            return $abstractUserTypes;
        }
        return null;
    }
}