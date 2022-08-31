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
