<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Repositories\Experience;
use App\Filter\ExperienceFilter;
use App\Repository\ExperienceRepository;
use App\Utils\Utils;

class ExperienceDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
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
        if ($list) {
            return $list;
        }
        return $this->experienceRepository->findAll();
    }
}
