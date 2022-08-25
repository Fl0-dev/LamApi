<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Repositories\AbstractUserType;
use App\Repository\AbstractUserTypeRepository;

class AbstractUserTypeDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private AbstractUserTypeRepository $abstractUserTypeRepository){}

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return AbstractUserType::class === $resourceClass;
    }
    
    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        return $this->abstractUserTypeRepository->findAll();
    }
    
}