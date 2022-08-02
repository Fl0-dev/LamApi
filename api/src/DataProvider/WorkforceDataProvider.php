<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Repositories\Workforce;
use App\Repository\WorkforceRepository;

class WorkforceDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private WorkforceRepository $workforceRepository){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Workforce::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        return $this->workforceRepository->findAll();
    }
}
