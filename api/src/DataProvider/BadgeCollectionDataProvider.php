<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Badge;
use Doctrine\Common\Collections\ArrayCollection;

final class BadgeCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Badge::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $subscriptions = new ArrayCollection();

        foreach (Badge::BADGES as $slug => $label) {
            $subscriptions->add(new Badge($slug));
        }

        return $subscriptions;
    }
}
