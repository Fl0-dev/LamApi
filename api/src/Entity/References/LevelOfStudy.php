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
            'controller' => NotFoundAction::class,
            'read' => false, // pour supprimer la lecture
            'output' => false, // pour supprimer la sortie
            'openapi_context' => [
                'summary' => 'hidden', //Indique le summary à supprimer avec openapiFactory  
            ]
        ],
    ]
)]
class LevelOfStudy extends Reference
{
    const UNSPECIFIED = 'non-precise';
    const CAP_BEP = 'cap-bep';
    const BAC = 'bac';
    const BAC_1 = 'bac+1';
    const BAC_2 = 'bac+2';
    const BAC_3 = 'bac+3';
    const BAC_4 = 'bac+4';
    const BAC_5 = 'bac+5';
    const BAC_6 = 'bac+6';
    const BAC_7 = 'bac+7';
    const BAC_8 = 'bac+8';

    const LEVEL_OF_STUDIES = [
        [
            'slug' => self::UNSPECIFIED,
            'label' => 'Non précisé'
        ],
        [
            'slug' => self::CAP_BEP,
            'label' => 'Cap BEP'
        ],
        [
            'slug' => self::BAC,
            'label' => 'BAC'
        ],
        [
            'slug' => self::BAC_1,
            'label' => 'BAC + 1'
        ],
        [
            'slug' => self::BAC_2,
            'label' => 'BAC + 2'
        ],
        [
            'slug' => self::BAC_3,
            'label' => 'BAC + 3'
        ],
        [
            'slug' => self::BAC_4,
            'label' => 'BAC + 4'
        ],
        [
            'slug' => self::BAC_5,
            'label' => 'BAC + 5'
        ],
        [
            'slug' => self::BAC_6,
            'label' => 'BAC + 6'
        ],
        [
            'slug' => self::BAC_7,
            'label' => 'BAC + 7'
        ],
        [
            'slug' => self::BAC_8,
            'label' => 'BAC + 8'
        ],
    ];

    public static function isLevelOfStudy($levelOfStudySlug)
    {
        return in_array($levelOfStudySlug, array_column(self::LEVEL_OF_STUDIES, 'slug'));
    }
}
