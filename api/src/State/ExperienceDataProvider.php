<?php

namespace App\State;

use App\Filter\ExperienceFilter;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class ExperienceDataProvider implements ProviderInterface
{
    public function __construct(private ExperienceRepository $experienceRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): iterable|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $list = Utils::getArrayValue(ExperienceFilter::EXPERIENCE_CONTEXT, $context);

            if (is_array($list)) {
                return $list;
            }
    
            return $this->experienceRepository->findAll();
        }

        return $this->experienceRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
