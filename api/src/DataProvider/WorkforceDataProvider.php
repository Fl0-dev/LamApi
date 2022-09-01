<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\References\Workforce;
use App\Filter\WorkforceFilter;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use App\Utils\Utils;

class WorkforceDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private WorkforceRepository $workforceRepository)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Workforce::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $list = Utils::getArrayValue(WorkforceFilter::WORKFORCE_CONTEXT, $context);

        if (is_array($list)) {
            return $list;
        }
        
        return $this->workforceRepository->findAll();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        return $this->workforceRepository->find($id);
    }
}
