<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ReferencesRepositories\ApplicantStatusRepository;
use App\Utils\Utils;

class ApplicantStatusDataProvider implements ProviderInterface
{

    public function __construct(private ApplicantStatusRepository $applicantStatusRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): iterable|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->applicantStatusRepository->findAll();
        }

        return $this->applicantStatusRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
