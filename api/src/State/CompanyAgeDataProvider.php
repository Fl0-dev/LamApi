<?php

namespace App\State;

use App\Repository\ReferencesRepositories\CompanyAgeRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class CompanyAgeDataProvider implements ProviderInterface
{
    public function __construct(private CompanyAgeRepository $companyAgeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->companyAgeRepository->findAll();
        }

        return $this->companyAgeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
