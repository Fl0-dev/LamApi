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

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $filters = Utils::getArrayValue('filters', $context);

            if (is_array($filters)) {
                $keyWords = Utils::getArrayValue(ContractTypeFilter::CONTRACT_TYPE_QUERY_PARAMETER, $filters);

                if (is_string($keyWords)) {
                    return $this->contractTypeRepository->findByKeyWords($keyWords);
                }
            }
    
            return $this->contractTypeRepository->findAll();
        }

        return $this->contractTypeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
