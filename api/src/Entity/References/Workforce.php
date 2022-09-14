<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\References\Reference;
use App\Filter\WorkforceFilter;

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
#[ApiFilter(WorkforceFilter::class)]
class Workforce extends Reference
{
    const LEVEL_1 = '1-a-9-salaries';
    const LEVEL_2 = '10-a-19-salaries';
    const LEVEL_3 = '20-a-49-salaries';
    const LEVEL_4 = '50-a-99-salaries';
    const LEVEL_5 = '100-a-199-salaries';
    const LEVEL_6 = '200-a-499-salaries';
    const LEVEL_7 = '500-a-999-salaries';
    const LEVEL_8 = '1000-a-1999-salaries';
    const LEVEL_9 = '2000-a-4999-salaries';
    const LEVEL_10 = '5000-a-9999-salaries';
    const LEVEL_11 = '+-de-10000-salaries';

    const WORKFORCES = [
        [
            'slug' => self::LEVEL_1,
            'label' => '1 à 9 salariés',
        ],
        [
            'slug' => self::LEVEL_2,
            'label' => '10 à 19 salariés',
        ],
        [
            'slug' => self::LEVEL_3,
            'label' => '20 à 49 salariés',
        ],
        [
            'slug' => self::LEVEL_4,
            'label' => '50 à 99 salariés',
        ],
        [
            'slug' => self::LEVEL_5,
            'label' => '100 à 199 salariés',
        ],
        [
            'slug' => self::LEVEL_6,
            'label' => '200 à 499 salariés',
        ],
        [
            'slug' => self::LEVEL_7,
            'label' => '500 à 999 salariés',
        ],
        [
            'slug' => self::LEVEL_8,
            'label' => '1000 à 1999 salariés',
        ],
        [
            'slug' => self::LEVEL_9,
            'label' => '2000 à 4999 salariés',
        ],
        [
            'slug' => self::LEVEL_10,
            'label' => '5000 à 9999 salariés',
        ],
        [
            'slug' => self::LEVEL_11,
            'label' => '+ de 10000 salariés',
        ]
    ];
}
