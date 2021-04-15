<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Subscription;
use Doctrine\Common\Collections\ArrayCollection;

final class SubscriptionCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Subscription::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $subscriptions = new ArrayCollection();

        foreach (Subscription::SUBSCRIPTIONS as $slug => $label) {
            $subscriptions->add(new Subscription($slug));
        }

        return $subscriptions;
    }
}
