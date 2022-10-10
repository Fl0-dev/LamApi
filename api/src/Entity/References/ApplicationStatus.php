<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\State\ApplicationStatusDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: ApplicationStatusDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: ApplicationStatusDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
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
            'label' => 'Archivée
        '
        ]
    ];

    public static function isApplicationStatus(array $statusSlugs): bool
    {
        return !empty(array_intersect($statusSlugs, array_column(self::APPLICATION_STATUSES, 'slug')));
    }
}
