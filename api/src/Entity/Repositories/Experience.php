<?php

namespace App\Entity\Repositories;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\ExperienceFilter;
use App\Transversal\Label;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;


#[ApiResource(
    collectionOperations: [
        'get' => [
            'method' => 'GET',
            'openapi_context' => [
                'tags' => ['Repositories'],
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'controller' => NotFoundAction::class,
            'read' => false,// pour supprimer la lecture
            'output' => false, // pour supprimer la sortie
            'openapi_context' => [
                'summary' => 'hidden',//Indique le summary à supprimer avec openapiFactory  
            ]
        ],
    ]
)]

#[ApiFilter(ExperienceFilter::class)]
class Experience
{
    const UNSPECIFIED = 0;
    const JUNIOR = 1;
    const CONFIRMED = 2;
    const SENIOR = 3;
    const EXPERT = 4;

    const EXPERIENCES = [
            0 => [
                'full'          => 'Non précisé',
                'label'         => 'Non précisé',
                'duration'      => 'Non précisé',
                'minNbMonths'   => 0
            ],
            1 => [
                'full'          => 'Lamajunior (- 1 an)',
                'label'         => 'Lamajunior',
                'duration'      => "< 1 an d'expérience",
                'minNbMonths'   => 0
            ],
            2 => [
                'full'          => 'Lamaffirmé (1 à 2 ans)',
                'label'         => 'Lamaffirmé',
                'duration'      => "de 1 à 2 ans d'expérience",
                'minNbMonths'   => 12
            ],
            3 => [
                'full'          => 'Lamasenior (2 à 5 ans)',
                'label'         => 'Lamasenior',
                'duration'      => "de 2 à 5 ans d'expérience",
                'minNbMonths'   => 24
            ],
            4 => [
                'full'          => 'Lamexpert (+ 5 ans)',
                'label'         => 'Lamexpert',
                'duration'      => "+ de 5 ans d'expérience",
                'minNbMonths'   => 60
            ]
        ];
    
    #[ApiProperty(identifier: true)]
    private $id;

    private ?int $value = null;

    private ?string $full = null;

    private ?string $duration = null;

    private ?int $minNbMonths = null;

    use Label;
    
    public function __construct(int $value ,string $label, string $full, string $duration, int $minNbMonths)
    {
        $this->id = Uuid::v3(Uuid::fromString(Uuid::NAMESPACE_URL), $label);
        $this->value = $value;
        $this->label = $label;
        $this->full = $full;
        $this->duration = $duration;
        $this->minNbMonths = $minNbMonths;
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

    public static function isExperience(int $value): bool
    {
        return isset(self::EXPERIENCES[$value]);
    }
}
