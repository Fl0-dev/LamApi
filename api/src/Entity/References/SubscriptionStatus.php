<?php

namespace App\Entity\References;

use App\Entity\References\Reference;

class SubscriptionStatus extends Reference
{
    public const ACTIVE = 'active';
    public const UNSUBSCRIBED = 'unsubscribed';

    public const STATUSES = [
        [
            'slug' => self::ACTIVE,
            'label' => 'Actif',
        ],
        [
            'slug' => self::UNSUBSCRIBED,
            'label' => 'Désinscrit',
        ],
    ];

    public static function isSubscriptionStatus(array $statusSlugs): bool
    {
        return !empty(array_intersect($statusSlugs, array_column(self::STATUSES, 'slug')));
    }
}
