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
            'controller' => NotFoundAction::class,
            'read' => false, // pour supprimer la lecture
            'output' => false, // pour supprimer la sortie
            'openapi_context' => [
                'summary' => 'hidden', //Indique le summary à supprimer avec openapiFactory  
            ]
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
