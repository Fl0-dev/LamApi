<?php

namespace App\State;


use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class LevelOfStudyDataProvider implements ProviderInterface
{
    public function __construct(private LevelOfStudyRepository $levelOfStudyRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): iterable|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->levelOfStudyRepository->findAll();
        }

        return $this->levelOfStudyRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
