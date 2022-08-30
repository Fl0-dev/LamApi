<?php

namespace App\Entity\References;

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
class AbstractUserType
{
    const JOB_BOARD = 'job_board';
    const ATS = 'ats';
    const PARTNER = 'partner';

    const USER_TYPES = [
        [
            'slug' => self::JOB_BOARD,
            'label' => 'Job Board'
        ],
        [
            'slug' => self::ATS,
            'label' => 'Ats'
        ],
        [
            'slug' => self::PARTNER,
            'label' => 'Partner'
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

    public static function isAbtractUserType(array $typeSlugs): bool
    {

        return !empty(array_intersect($typeSlugs, array_column(self::USER_TYPES, 'slug')));
    }
}
