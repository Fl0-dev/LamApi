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

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $filters = Utils::getArrayValue('filters', $context);

            if (is_array($filters)) {
                $keyWords = Utils::getArrayValue(ExperienceFilter::EXPERIENCE_QUERY_PARAMETER, $filters);

                if (is_string($keyWords)) {
                    return $this->experienceRepository->findByKeyWords($keyWords);
                }
            }

            return $this->experienceRepository->findAll();
        }

        return $this->experienceRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
