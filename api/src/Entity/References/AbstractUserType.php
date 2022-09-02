<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Transversal\Label;
use App\Transversal\Slug;
use Symfony\Component\Uid\Uuid;

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
class AbstractUserType extends Reference
{
    const JOB_BOARD = 'job_board';
    const ATS = 'ats';
    const PARTNER = 'partner';

    const USER_TYPES = [
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
        ],
    ];

    public static function isAbtractUserType(array $typeSlugs): bool
    {
        return !empty(array_intersect($typeSlugs, array_column(self::USER_TYPES, 'slug')));
    }
}
