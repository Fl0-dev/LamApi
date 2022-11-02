<?php

namespace App\State;

use App\Repository\ReferencesRepositories\MiddleAgeRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class MiddleAgeDataProvider implements ProviderInterface
{
    public function __construct(private MiddleAgeRepository $middleAgeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->middleAgeRepository->findAll();
        }

        return $this->middleAgeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
