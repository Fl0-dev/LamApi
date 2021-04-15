<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Badge;

final class BadgeItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Badge::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $slug, string $operationName = null, array $context = []): ?Badge
    {
        if (Badge::isSlug($slug)) {
            return new Badge($slug);
        }

        return null;
    }
}
