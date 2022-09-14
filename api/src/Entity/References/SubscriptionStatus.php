<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\References\Reference;
use App\Filter\WorkforceFilter;


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
}