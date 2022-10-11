<?php

namespace App\State;


use App\Repository\ReferencesRepositories\OfferStatusRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class OfferStatusDataProvider implements ProviderInterface
{
    public function __construct(private OfferStatusRepository $offerStatusRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->offerStatusRepository->findAll();
        }

        return $this->offerStatusRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
