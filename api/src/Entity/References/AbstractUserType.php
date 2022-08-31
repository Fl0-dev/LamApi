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
            'controller' => NotFoundAction::class,
            'read' => false, // pour supprimer la lecture
            'output' => false, // pour supprimer la sortie
            'openapi_context' => [
                'summary' => 'hidden', //Indique le summary à supprimer avec openapiFactory  
            ]
        ],
    ]
)]
class AbstractUserType extends Reference
{
    const JOB_BOARD = 'job-board';
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
