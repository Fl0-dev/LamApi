<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\ReferencesRepositories\OfferStatusRepository;

class OfferStatusDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private OfferStatusRepository $statusRepository)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return OfferStatus::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        return $this->statusRepository->findAll();
    }
}
