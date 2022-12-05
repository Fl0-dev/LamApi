<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use App\Entity\References\Reference;
use App\Filter\WorkforceFilter;
use App\State\WorkforceDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: WorkforceDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: WorkforceDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
#[ApiFilter(WorkforceFilter::class)]
class Workforce extends Reference
{
    public const LEVEL_1 = '1-a-9-salaries';
    public const LEVEL_2 = '10-a-19-salaries';
    public const LEVEL_3 = '20-a-49-salaries';
    public const LEVEL_4 = '50-a-99-salaries';
    public const LEVEL_5 = '100-a-199-salaries';
    public const LEVEL_6 = '200-a-499-salaries';
    public const LEVEL_7 = '500-a-999-salaries';
    public const LEVEL_8 = '1000-a-1999-salaries';
    public const LEVEL_9 = '2000-a-4999-salaries';
    public const LEVEL_10 = '5000-a-9999-salaries';
    public const LEVEL_11 = '+-de-10000-salaries';
    public const WORKFORCES = [
        [
            'slug' => self::LEVEL_1,
            'label' => '1 à 9 salariés',
            'level' => 1
        ],
        [
            'slug' => self::LEVEL_2,
            'label' => '10 à 19 salariés',
            'level' => 2

        ],
        [
            'slug' => self::LEVEL_3,
            'label' => '20 à 49 salariés',
            'level' => 3
        ],
        [
            'slug' => self::LEVEL_4,
            'label' => '50 à 99 salariés',
            'level' => 4
        ],
        [
            'slug' => self::LEVEL_5,
            'label' => '100 à 199 salariés',
            'level' => 5
        ],
        [
            'slug' => self::LEVEL_6,
            'label' => '200 à 499 salariés',
            'level' => 6
        ],
        [
            'slug' => self::LEVEL_7,
            'label' => '500 à 999 salariés',
            'level' => 7
        ],
        [
            'slug' => self::LEVEL_8,
            'label' => '1000 à 1999 salariés',
            'level' => 8
        ],
        [
            'slug' => self::LEVEL_9,
            'label' => '2000 à 4999 salariés',
            'level' => 9
        ],
        [
            'slug' => self::LEVEL_10,
            'label' => '5000 à 9999 salariés',
            'level' => 10
        ],
        [
            'slug' => self::LEVEL_11,
            'label' => '+ de 10000 salariés',
            'level' => 11
        ]
    ];

    private int $level;

    public function __construct(
        string $slug,
        string $label,
        int $level
    ) {
        parent::__construct($slug, $label);
        $this->level = $level;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public static function isWorkforce(array $workforceSlugs): bool
    {
        return !empty(array_intersect($workforceSlugs, array_column(self::WORKFORCES, 'slug')));
    }
}
