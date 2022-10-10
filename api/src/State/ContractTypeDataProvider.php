<?php

namespace App\State;

use App\Filter\ContractTypeFilter;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class ContractTypeDataProvider implements ProviderInterface
{
    public function __construct(private ContractTypeRepository $contractTypeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): iterable|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $list = Utils::getArrayValue(ContractTypeFilter::CONTRACT_TYPE_CONTEXT, $context);

            if (is_array($list)) {
                return $list;
            }
    
            return $this->contractTypeRepository->findAll();
        }

        return $this->contractTypeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
