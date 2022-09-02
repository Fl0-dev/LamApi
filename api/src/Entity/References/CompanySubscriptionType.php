<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'method' => 'GET',
            'openapi_context' => [
                'tags' => ['References'],
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'method' => 'GET',
            'openapi_context' => [
                'tags' => ['References by id'],
            ],
        ], 
    ]
)]
class CompanySubscriptionType extends Reference
{
    const FREE = 'free';
    const PREMIUM = 'premium';

    const COMPANY_SUBSCRIPTION_TYPES = [
        [
            'slug' => self::FREE,
            'label' => 'Free'
        ],
        [
            'slug' => self::PREMIUM,
            'label' => 'Premium'
        ],
    ];

    public static function isCompanySubscriptionType(array $typeSlugs): bool
    {
        return !empty(array_intersect($typeSlugs, array_column(self::COMPANY_SUBSCRIPTION_TYPES, 'slug')));
    }
}