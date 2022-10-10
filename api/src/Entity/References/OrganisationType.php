<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\State\OrganisationTypeDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: OrganisationTypeDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: OrganisationTypeDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
class OrganisationType extends Reference
{
    const GROUP = 'group';
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
        ]
    ];
    
    public static function isOrganisationType(array $typeSlugs): bool
    {
        return !empty(array_intersect($typeSlugs, array_column(self::ORGANISATION_TYPES, 'slug')));
    }
}
