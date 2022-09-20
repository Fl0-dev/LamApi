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
class ApplicationStatus extends Reference
{
    const NEW = 'new';
    const IN_PROGRESS = 'in_progress';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const ARCHIVED = 'archived';

    const APPLICATION_STATUSES = [
        [
            'slug' => self::NEW,
            'label' => 'Nouvelle candidature'
        ],
        [
            'slug' => self::IN_PROGRESS,
            'label' => 'En traitement'
        ],
        [
            'slug' => self::APPROVED,
            'label' => 'Approuvée'
        ],
        [
            'slug' => self::REJECTED,
            'label' => 'Rejetée'
        ],
        [
            'slug' => self::ARCHIVED,
            'label' => 'Archivée'
        ],
    ];
}
