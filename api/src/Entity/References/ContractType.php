<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use App\Filter\ContractTypeFilter;
use App\State\ContractTypeDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: ContractTypeDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: ContractTypeDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
#[ApiFilter(filterClass: ContractTypeFilter::class)]
class ContractType extends Reference
{
    public const CDD = 'cdd';
    public const CDI = 'cdi';
    public const ALTERNANCE = 'alternance';
    public const INTERNSHIP = 'internship';
    public const FREELANCE = 'freelance';
    public const CONTRACT_TYPES = [
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
        ]
    ];

    public static function isContractType(string $contractTypeSlug): ?bool
    {
        return in_array($contractTypeSlug, array_column(self::CONTRACT_TYPES, 'slug'));
    }
}
