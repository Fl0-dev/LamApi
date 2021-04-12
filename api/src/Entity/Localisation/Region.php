<?php

namespace App\Entity\Localisation;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Trait\Slug;
use App\Trait\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Localisation: Region
 *
 * @ORM\Entity
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class Region
{
    use Uuid;
    use Slug;

    /**
     * Region Departments
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Localisation\Department", mappedBy="region")
     */
    private ?ArrayCollection $departments = null;

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
     * Get Departments of the Region
     */
    public function getDepartments(): ?ArrayCollection
    {
        return $this->departments;
    }

    /**
     * Set Departments of the Region
     */
    public function setDepartments(?ArrayCollection $departments): self
    {
        $this->departments = $departments;

        return $this;
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
}
