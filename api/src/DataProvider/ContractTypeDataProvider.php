<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Repositories\ContractType;
use App\Repository\ContractTypeRepository;

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
        return $this->contractTypeRepository->findAll();
    }
}

