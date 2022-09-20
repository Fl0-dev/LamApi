<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\ExperienceFilter;
use App\Transversal\Label;
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
            'method' => 'GET',
            'openapi_context' => [
                'tags' => ['References by id'],
            ],
        ], 
    ]
)]

#[ApiFilter(ExperienceFilter::class)]
class Experience extends Reference
{
    const UNSPECIFIED = 0;
    const JUNIOR = 1;
    const CONFIRMED = 2;
    const SENIOR = 3;
    const EXPERT = 4;

    const EXPERIENCES = [
        0 => [
            'full'          => 'Non précisé',
            'slug'          => 'non-precise',
            'label'         => 'Non précisé',
            'duration'      => 'Non précisé',
            'minNbMonths'   => 0
        ],
        1 => [
            'full'          => 'Lamajunior (- 1 an)',
            'slug'          => 'lamajunior',
            'label'         => 'Lamajunior',
            'duration'      => "< 1 an d'expérience",
            'minNbMonths'   => 0
        ],
        2 => [
            'full'          => 'Lamaffirmé (1 à 2 ans)',
            'slug'          => 'lamaffirmé',
            'label'         => 'Lamaffirmé',
            'duration'      => "de 1 à 2 ans d'expérience",
            'minNbMonths'   => 12
        ],
        3 => [
            'full'          => 'Lamasenior (2 à 5 ans)',
            'slug'          => 'lamasenior',
            'label'         => 'Lamasenior',
            'duration'      => "de 2 à 5 ans d'expérience",
            'minNbMonths'   => 24
        ],
        4 => [
            'full'          => 'Lamexpert (+ 5 ans)',
            'slug'          => 'lamexpert',
            'label'         => 'Lamexpert',
            'duration'      => "+ de 5 ans d'expérience",
            'minNbMonths'   => 60
        ]
    ];

    private ?int $value = null;

    private ?string $full = null;

    private ?string $duration = null;

    private ?int $minNbMonths = null;


    public function __construct(string $slug, string $label ,int $value, string $full, string $duration, int $minNbMonths)
    {
        parent::__construct($slug, $label);
        $this->value = $value;
        $this->full = $full;
        $this->duration = $duration;
        $this->minNbMonths = $minNbMonths;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of full
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * Set the value of full
     *
     * @return  self
     */
    public function setFull($full)
    {
        $this->full = $full;

        return $this;
    }

    /**
     * Get the value of duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of minNbMonths
     */
    public function getMinNbMonths()
    {
        return $this->minNbMonths;
    }

    /**
     * Set the value of minNbMonths
     *
     * @return  self
     */
    public function setMinNbMonths($minNbMonths)
    {
        $this->minNbMonths = $minNbMonths;

        return $this;
    }

    public static function isExperience(int $experience): bool
    {
        return array_key_exists($experience, self::EXPERIENCES);
    }
}
