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
class OfferStatus
{
    const DRAFT = 'draft';
    const PUBLISHED = 'published';
    const PROVIDED = 'provided';
    const DISABLED = 'disabled';
    const ARCHIVED = 'archived';

    const STATUSES = [
        [
            'slug' => self::DRAFT,
            'label' => 'Draft'
        ],
        [
            'slug' => self::PUBLISHED,
            'label' => 'Published'
        ],
        [
            'slug' => self::PROVIDED,
            'label' => 'Provided'
        ],
        [
            'slug' => self::DISABLED,
            'label' => 'Disabled'
        ],
        [
            'slug' => self::ARCHIVED,
            'label' => 'Archived'
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

    public static function isStatus($statusSlug)
    {
        return in_array($statusSlug, array_column(self::STATUSES, 'slug'));
    }
}
