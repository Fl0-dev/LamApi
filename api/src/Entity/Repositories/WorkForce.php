<?php

namespace App\Entity\Repositories;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Transversal\Label;
use App\Transversal\Slug;
use Symfony\Component\Uid\Uuid;

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
class Workforce
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
            1 => [
                'slug'          => self::LEVEL_1,
                'label'         => '1 à 9 salariés',
            ],
            2 => [
                'slug'          => self::LEVEL_2,
                'label'         => '10 à 19 salariés',
            ],
            3 => [
                'slug'          => self::LEVEL_3,
                'label'         => '20 à 49 salariés',
            ],
            4 => [
                'slug'          => self::LEVEL_4,
                'label'         => '50 à 99 salariés',
            ],
            5 => [
                'slug'          => self::LEVEL_5,
                'label'         => '100 à 199 salariés',
            ],
            6 => [
                'slug'          => self::LEVEL_6,
                'label'         => '200 à 499 salariés',
            ],
            7 => [
                'slug'          => self::LEVEL_7,
                'label'         => '500 à 999 salariés',
            ],
            8 => [
                'slug'          => self::LEVEL_8,
                'label'         => '1000 à 1999 salariés',
            ],
            9 => [
                'slug'          => self::LEVEL_9,
                'label'         => '2000 à 4999 salariés',
            ],
            10 => [
                'slug'          => self::LEVEL_10,
                'label'         => '5000 à 9999 salariés',
            ],
            11 => [
                'slug'          => self::LEVEL_11,
                'label'         => '+ de 10000 salariés',
            ]
        ];

    #[ApiProperty(identifier: true)]
    private $id;


    private ?int $value = null;

    use Slug;
    use Label;

    public function __construct(int $value, string $slug, string $label)
    {
        $this->id = Uuid::v3(Uuid::fromString(Uuid::NAMESPACE_URL), $slug);
        $this->value = $value;
        $this->slug = $slug;
        $this->label = $label;
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
}
