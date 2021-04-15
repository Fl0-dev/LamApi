<?php

namespace App\Entity\Localisation;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Trait\Slug;
use App\Trait\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Entity
 */
#[ApiResource(
    routePrefix: '/localisation',
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class City
{
    use Uuid;
    use Slug;

    /**
     * City Department
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation\Department", inversedBy="cities")
     */
    private ?string $department = null;

    /**
     * City Zip Code
     *
     * @ORM\Column(type="string")
     */
    private ?string $zipCode = null;

    /**
     * City Name
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
     * Get the value of Department
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    /**
     * Set the value of Department
     */
    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Check if has a valid Department
     */
    public function hasDepartment(): bool
    {
        return $this->getDepartment() instanceof Department;
    }

    /**
     * Get the value of Zip Code
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * Set the value of Zip Code
     */
    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

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

    /**
     * Get City Full Name (with Department)
     */
    public function getFullName(): ?string
    {
        if ($this->hasName() && $this->hasDepartment() && $this->getDepartment()->hasCode()) {
            return $this->getName() . ' (' . $this->getDepartment()->getCode() . ')';
        }
    }
}
