<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\State\AbstractUserTypeDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: AbstractUserTypeDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: AbstractUserTypeDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
class AbstractUserType extends Reference
{
    public const JOB_BOARD = 'job-board';
    public const ATS = 'ats';
    public const PARTNER = 'partner';
    public const USER_TYPES = [
        [
            'slug' => self::JOB_BOARD,
            'label' => 'Job Board'
        ],
        [
            'slug' => self::ATS,
            'label' => 'Ats'
        ],
        [
            'slug' => self::PARTNER,
            'label' => 'Partner'
        ]
    ];

    public static function isAbtractUserType(array $typeSlugs): bool
    {
        return !empty(array_intersect($typeSlugs, array_column(self::USER_TYPES, 'slug')));
    }
}
