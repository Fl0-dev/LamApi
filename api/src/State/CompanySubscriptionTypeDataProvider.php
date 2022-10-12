<?php

namespace App\State;

use App\Repository\ReferencesRepositories\CompanySubscriptionTypeRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class CompanySubscriptionTypeDataProvider implements ProviderInterface
{
    public function __construct(private CompanySubscriptionTypeRepository $companySubscriptionTypeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->companySubscriptionTypeRepository->findAll();
        }

        return $this->companySubscriptionTypeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
