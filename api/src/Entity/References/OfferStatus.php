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
class OfferStatus extends Reference
{
    const DRAFT = 'draft';
    const PUBLISHED = 'published';
    const PROVIDED = 'provided';
    const DISABLED = 'disabled';
    const ARCHIVED = 'archived';

    const STATUSES = [
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
        ],
    ];

    public static function isStatus($statusSlug)
    {
        return in_array($statusSlug, array_column(self::STATUSES, 'slug'));
    }
}
