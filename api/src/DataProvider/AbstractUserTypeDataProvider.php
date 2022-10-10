<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\References\AbstractUserType;
use App\Repository\ReferencesRepositories\AbstractUserTypeRepository;

class AbstractUserTypeDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface ,RestrictedDataProviderInterface
{
    public function __construct(private AbstractUserTypeRepository $abstractUserTypeRepository)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return AbstractUserType::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ?iterable
    {
        return $this->abstractUserTypeRepository->findAll();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?object
    {
        return $this->abstractUserTypeRepository->find($id);
    }
}
