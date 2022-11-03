<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\References\Reference;
use App\State\MiddleAgeDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: MiddleAgeDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: MiddleAgeDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
class MiddleAge extends Reference
{
    public const LEVEL_1 = '20-a-25-ans';
    public const LEVEL_2 = '26-a-30-ans';
    public const LEVEL_3 = '31-a-35-ans';
    public const LEVEL_4 = '36-a-40-ans';
    public const LEVEL_5 = '41-a-45-ans';
    public const LEVEL_6 = '50-et-plus';
    public const MIDDLE_AGES = [
        [
            'slug' => self::LEVEL_1,
            'label' => '20 à 25 ans'
        ],
        [
            'slug' => self::LEVEL_2,
            'label' => '26 à 30 ans'
        ],
        [
            'slug' => self::LEVEL_3,
            'label' => '31 à 35 ans'
        ],
        [
            'slug' => self::LEVEL_4,
            'label' => '36 à 40 ans'
        ],
        [
            'slug' => self::LEVEL_5,
            'label' => '41 à 45 ans'
        ],
        [
            'slug' => self::LEVEL_6,
            'label' => '50 et plus'
        ],
    ];

    public static function isMiddleAge(array $middleAgeSlugs): bool
    {
        return !empty(array_intersect($middleAgeSlugs, array_column(self::MIDDLE_AGES, 'slug')));
    }
}
