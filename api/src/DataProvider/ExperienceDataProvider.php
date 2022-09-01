<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\References\Experience;
use App\Filter\ExperienceFilter;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Utils\Utils;

class ExperienceDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private ExperienceRepository $experienceRepository)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Experience::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $list = Utils::getArrayValue(ExperienceFilter::EXPERIENCE_CONTEXT, $context);

        if (is_array($list)) {
            return $list;
        }

        return $this->experienceRepository->findAll();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        return $this->experienceRepository->find($id);
    }
}
