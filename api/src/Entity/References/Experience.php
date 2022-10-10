<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use App\Filter\ExperienceFilter;
use App\State\ExperienceDataProvider;

#[
    ApiResource(operations: [
        new Get(
            provider: ExperienceDataProvider::class,
            openapiContext: ['tags' => ['References by id']]
        ),
        new GetCollection(
            provider: ExperienceDataProvider::class,
            openapiContext: ['tags' => ['References']]
        )
    ])
]
#[ApiFilter(filterClass: ExperienceFilter::class)]
class Experience extends Reference
{
    const UNSPECIFIED = 0;
    const JUNIOR = 1;
    const CONFIRMED = 2;
    const SENIOR = 3;
    const EXPERT = 4;
    const EXPERIENCES = [
        0 => [
            'slug' => 'non-precise',
            'label' => 'Non précisé',
            'full' => 'Non précisé',
            'duration' => 'Non précisé',
            'minNbMonths' => 0
        ],
        1 => [
            'slug' => 'lamajunior',
            'label' => 'Lamajunior',
            'full' => 'Lamajunior (- 1 an)',
            'duration' => "< 1 an d'expérience",
            'minNbMonths' => 0
        ],
        2 => [
            'slug' => 'lamaffirmé',
            'label' => 'Lamaffirmé',
            'full' => 'Lamaffirmé (1 à 2 ans)',
            'duration' => "de 1 à 2 ans d'expérience",
            'minNbMonths' => 12
        ],
        3 => [
            'slug' => 'lamasenior',
            'label' => 'Lamasenior',
            'full' => 'Lamasenior (2 à 5 ans)',
            'duration' => "de 2 à 5 ans d'expérience",
            'minNbMonths' => 24
        ],
        4 => [
            'slug' => 'lamexpert',
            'label' => 'Lamexpert',
            'full' => 'Lamexpert (+ 5 ans)',
            'duration' => "+ de 5 ans d'expérience",
            'minNbMonths' => 60
        ]
    ];

    private ?int $value = null;
    private ?string $full = null;
    private ?string $duration = null;
    private ?int $minNbMonths = null;

    public function __construct(string $slug, string $label, int $value, string $full, string $duration, int $minNbMonths)
    {
        parent::__construct($slug, $label);
        $this->value = $value;
        $this->full = $full;
        $this->duration = $duration;
        $this->minNbMonths = $minNbMonths;
    }
   
    public function getValue(): ?int
    {
        return $this->value;
    }
    
    public function setValue(int $value): self
    {
        $this->value = $value;
        
        return $this;
    }
   
    public function getFull(): ?string
    {
        return $this->full;
    }
    
    public function setFull(string $full): self
    {
        $this->full = $full;

        return $this;
    }
    
    public function getDuration(): ?string
    {
        return $this->duration;
    }
    
    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
    
    public function getMinNbMonths(): ?int
    {
        return $this->minNbMonths;
    }
    
    public function setMinNbMonths(int $minNbMonths): self
    {
        $this->minNbMonths = $minNbMonths;
        
        return $this;
    }

    public static function isExperience(int $experience): bool
    {
        return array_key_exists($experience, self::EXPERIENCES);
    }
}
