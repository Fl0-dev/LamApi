<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\References\CompanySubscriptionType;
use App\Repository\ReferencesRepositories\CompanySubscriptionTypeRepository;

class CompanySubscriptionTypeDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private CompanySubscriptionTypeRepository $companySubscriptionTypeRepository)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return CompanySubscriptionType::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ?iterable
    {
        return $this->companySubscriptionTypeRepository->findAll();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?object
    {
        return $this->companySubscriptionTypeRepository->find($id);
    }
}