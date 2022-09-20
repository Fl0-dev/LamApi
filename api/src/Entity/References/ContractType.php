<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\ContractTypeFilter;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'method' => 'GET',
            'openapi_context' => [
                'tags' => ['References'],
            ],
        ],
        'post' => [
            'controller' => NotFoundAction::class,
            'read' => false, // pour supprimer la lecture
            'output' => false, // pour supprimer la sortie
            'openapi_context' => [
                'summary' => 'hidden', //Indique le summary à supprimer avec openapiFactory  
            ]
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
#[ApiFilter(ContractTypeFilter::class)]
class ContractType extends Reference
{
    const CDD = 'cdd';
    const CDI = 'cdi';
    const ALTERNANCE = 'alternance';
    const INTERNSHIP = 'internship';
    const FREELANCE = 'freelance';

    const CONTRACT_TYPES = [
        [
            'slug' => self::CDD,
            'label' => 'CDD'
        ],
        [
            'slug' => self::CDI,
            'label' => 'CDI'
        ],
        [
            'slug' => self::ALTERNANCE,
            'label' => 'Alternance'
        ],
        [
            'slug' => self::INTERNSHIP,
            'label' => 'Stage'
        ],
        [
            'slug' => self::FREELANCE,
            'label' => 'Indépendant'
        ],
    ];

    public static function isContractType(string $contractTypeSlug): ?bool
    {
        return in_array($contractTypeSlug, array_column(self::CONTRACT_TYPES, 'slug'));
    }
}
