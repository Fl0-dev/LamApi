<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Repositories\ApplicationStatus;
use App\Repository\ApplicationStatusRepository;

class ApplicationStatusDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    public function __construct(private ApplicationStatusRepository $applicantStatusRepository){}
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ApplicationStatus::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        return $this->applicantStatusRepository->findAll();
    }
}