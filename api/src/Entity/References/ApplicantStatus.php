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
class ApplicantStatus extends Reference
{
    const ACTIVE = 'active';
    const IN_RESEARCH = 'in_research';
    const NOT_LOOKING = 'not_looking';
    const ARCHIVED = 'archived';

    const APPLICANT_STATUSES = [
        [
            'slug' => self::ACTIVE,
            'label' => 'active'
        ],
        [
            'slug' => self::IN_RESEARCH,
            'label' => 'in_research'
        ],
        [
            'slug' => self::NOT_LOOKING,
            'label' => 'not_looking'
        ],
        [
            'slug' => self::ARCHIVED,
            'label' => 'archived'
        ],
    ];
}
