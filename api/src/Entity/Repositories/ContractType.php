<?php

namespace App\Entity\Repositories;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\ContractTypeFilter;
use Symfony\Component\Uid\Uuid;
use App\Transversal\Label;
use App\Transversal\Slug;

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
#[ApiFilter(ContractTypeFilter::class)]
class ContractType
{

    const CDD = 'cdd';
    const CDI = 'cdi';
    const ALTERNANCE = 'alternance';
    const INTERNSHIP = 'stage';
    const FREELANCE = 'independant';

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

    #[ApiProperty(identifier: true)]
    private $id;

    use Slug;
    use Label;
    
    public function __construct(string $slug, string $label)
    {
        $this->id = Uuid::v3(Uuid::fromString(Uuid::NAMESPACE_URL), $slug);
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
}
