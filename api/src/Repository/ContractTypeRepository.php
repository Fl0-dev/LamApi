<?php

namespace App\Repository;

use App\Entity\Repositories\ContractType;
use App\Utils\Utils;

class ContractTypeRepository
{
    /**
     * Undocumented function
     *
     * @return ContractType[]
     */
    public function findAll():array
    {
        $contractTypes = [];
        $arrayContractTypes = ContractType::CONTRACT_TYPES;
        if(is_array($arrayContractTypes) && !empty($arrayContractTypes)){
            foreach ($arrayContractTypes as $contractType) {
                $contractTypes[] = new ContractType(Utils::getArrayValue('slug', $contractType), Utils::getArrayValue('label', $contractType));
            }
            return $contractTypes;
        }
        return null; 
    }
}