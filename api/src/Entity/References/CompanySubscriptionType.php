<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\State\CompanySubscriptionTypeDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: CompanySubscriptionTypeDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: CompanySubscriptionTypeDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
class CompanySubscriptionType extends Reference
{
    public const FREE = 'free';
    public const PREMIUM = 'premium';
    public const COMPANY_SUBSCRIPTION_TYPES = [
        [
            'slug' => self::FREE,
            'label' => 'Free'
        ],
        [
            'slug' => self::PREMIUM,
            'label' => 'Premium'
        ]
    ];

    public static function isCompanySubscriptionType(array $typeSlugs): bool
    {
        return !empty(array_intersect($typeSlugs, array_column(self::COMPANY_SUBSCRIPTION_TYPES, 'slug')));
    }
}
