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
class OrganisationType  extends Reference
{
    const GROUP= 'group';
    const EDITOR = 'editeur';
    const LABEL = 'label';

    const ORGANISATION_TYPES = [
        [
            'slug' => self::GROUP,
            'label' => 'Groupement'
        ],
        [
            'slug' => self::EDITOR,
            'label' => 'Editeur'
        ],
        [
            'slug' => self::LABEL,
            'label' => 'Label'
        ],
    ];
        
    public static function isOrganisationType(array $typeSlugs): bool
    {
        return !empty(array_intersect($typeSlugs, array_column(self::ORGANISATION_TYPES, 'slug')));
    }
}