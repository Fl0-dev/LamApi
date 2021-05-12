<?php

namespace App\Entity\Localisation;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Trait\Slug;
use App\Trait\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Localisation: Region
 *
 * @ORM\Entity
 */
#[ApiResource(
    routePrefix: '/localisation',
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class Region
{
    use Uuid;
    use Slug;

    /**
     * Region Code
     *
     * @ORM\Column(type="string")
     */
    private ?string $code = null;

    /**
     * Region Name
     *
     * @ORM\Column(type="string")
     */
    private ?string $name = null;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get the value of Code
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set the value of Code
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Check if has a valid Name
     */
    public function hasName(): bool
    {
        $name = $this->getName();

        return is_string($name) && strlen($name) > 0;
    }
}
