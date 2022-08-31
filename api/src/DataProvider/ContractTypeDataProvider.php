<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\References\ContractType;
use App\Filter\ContractTypeFilter;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use App\Utils\Utils;

class ContractTypeDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private ContractTypeRepository $contractTypeRepository)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ContractType::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $list = Utils::getArrayValue(ContractTypeFilter::CONTRACT_TYPE_CONTEXT, $context);

        if (is_array($list)) {
            return $list;
        }
        
        return $this->contractTypeRepository->findAll();
    }
}
