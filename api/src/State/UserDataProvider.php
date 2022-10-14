<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\UserRepositories\UserRepository;
use App\Utils\Utils;

class UserDataProvider implements ProviderInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            return $this->userRepository->findAllUsers();
        }

        return $this->userRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
