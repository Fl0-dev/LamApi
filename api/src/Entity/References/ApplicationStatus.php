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
    public const NEW = 'new';
    public const IN_PROGRESS = 'in_progress';
    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';
    public const ARCHIVED = 'archived';
    public const APPLICATION_STATUSES = [
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
