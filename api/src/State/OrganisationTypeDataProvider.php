<?php

namespace App\State;

use App\Repository\ReferencesRepositories\OrganisationTypeRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class OrganisationTypeDataProvider implements ProviderInterface
{
    public function __construct(private OrganisationTypeRepository $organisationTypeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->organisationTypeRepository->findAll();
        }

        return $this->organisationTypeRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
