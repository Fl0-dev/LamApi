<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\JobType;
use Doctrine\Common\Collections\ArrayCollection;

final class JobTypeCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return JobType::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $jobTypes = new ArrayCollection();

        foreach (JobType::JOB_TYPES as $slug => $label) {
            $jobTypes->add(new JobType($slug));
        }

        return $jobTypes;
    }
}
