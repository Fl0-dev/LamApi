<?php

namespace App\State;

use App\Repository\ReferencesRepositories\ApplicationStatusRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class ApplicationStatusDataProvider implements ProviderInterface
{
    public function __construct(private ApplicationStatusRepository $applicationStatusRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->applicationStatusRepository->findAll();
        }

        return $this->applicationStatusRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
