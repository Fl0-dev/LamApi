<?php

namespace App\Entity\References;

use App\Entity\References\Reference;

class SubscriptionStatus extends Reference
{
    const ACTIVE = 'active';
    const UNSUBSCRIBED = 'unsubscribed';

    const STATUSES = [
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