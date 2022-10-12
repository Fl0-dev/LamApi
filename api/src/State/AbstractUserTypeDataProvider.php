<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use App\Repository\ReferencesRepositories\AbstractUserTypeRepository;
use ApiPlatform\State\ProviderInterface;
use App\Utils\Utils;

class AbstractUserTypeDataProvider implements ProviderInterface
{
    public function __construct(private AbstractUserTypeRepository $abstractUserTypeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->abstractUserTypeRepository->findAll();
        }

        return $this->abstractUserTypeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
