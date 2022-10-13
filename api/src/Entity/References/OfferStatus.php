<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\State\OfferStatusDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: OfferStatusDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: OfferStatusDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
class OfferStatus extends Reference
{
    public const DRAFT = 'draft';
    public const PUBLISHED = 'published';
    public const PROVIDED = 'provided';
    public const DISABLED = 'disabled';
    public const ARCHIVED = 'archived';
    public const STATUSES = [
        [
            'slug' => self::DRAFT,
            'label' => 'Draft'
        ],
        [
            'slug' => self::PUBLISHED,
            'label' => 'Published'
        ],
        [
            'slug' => self::PROVIDED,
            'label' => 'Provided'
        ],
        [
            'slug' => self::DISABLED,
            'label' => 'Disabled'
        ],
        [
            'slug' => self::ARCHIVED,
            'label' => 'Archived'
        ]
    ];

    public static function isStatus($statusSlug)
    {
        return in_array($statusSlug, array_column(self::STATUSES, 'slug'));
    }
}
