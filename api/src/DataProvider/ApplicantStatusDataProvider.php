<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Repositories\ApplicantStatus;
use App\Repository\ApplicantStatusRepository;

class ApplicantStatusDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    public function __construct(private ApplicantStatusRepository $applicantStatusRepository){}
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return ApplicantStatus::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        return $this->applicantStatusRepository->findAll();
    }
}