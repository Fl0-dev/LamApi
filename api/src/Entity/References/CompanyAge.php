<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\References\Reference;
use App\State\CompanyAgeDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: CompanyAgeDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: CompanyAgeDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
class CompanyAge extends Reference
{
    public const LEVEL_1 = 'moins-de-1-an';
    public const LEVEL_2 = '1-a-2-ans';
    public const LEVEL_3 = '2-a-5-ans';
    public const LEVEL_4 = '5-a-10-ans';
    public const LEVEL_5 = '10-a-20-ans';
    public const LEVEL_6 = 'plus-de-20-ans';
    public const COMPANY_AGES = [
        [
            'slug' => self::LEVEL_1,
            'label' => 'Moins d\'un an'
        ],
        [
            'slug' => self::LEVEL_2,
            'label' => '1 à 2 ans'
        ],
        [
            'slug' => self::LEVEL_3,
            'label' => '2 à 5 ans'
        ],
        [
            'slug' => self::LEVEL_4,
            'label' => '5 à 10 ans'
        ],
        [
            'slug' => self::LEVEL_5,
            'label' => '10 à 20 ans'
        ],
        [
            'slug' => self::LEVEL_6,
            'label' => 'Plus de 20 ans'
        ],
    ];

    public static function isCompanyAge(array $middleAgeSlugs): bool
    {
        return !empty(array_intersect($middleAgeSlugs, array_column(self::COMPANY_AGES, 'slug')));
    }
}
