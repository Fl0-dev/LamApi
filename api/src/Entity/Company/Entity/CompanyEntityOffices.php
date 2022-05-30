<?php

namespace App\Entity\Company\Entity;

use App\Entity\Localisation\Address;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyEntity Offices
 */
trait CompanyEntityOffices
{
    /**
     * CompanyEntity Addresses
     *
     * @var ArrayCollection<Address>
     *
     */
    #[ORM\ManyToMany(targetEntity: Address::class)]
    #[ORM\JoinTable(name: "company_entity_offices_addresses")]
    #[ORM\JoinColumn(name: "company_entity_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "address_id", referencedColumnName: "id")]
    private iterable $addresses;

    /**
     * Number of CompanyEntity Offices
     */
    #[ORM\Column(type: "integer")]
    private ?int $officesNumber = null;

    /**
     * Get CompanyEntity Addresses
     */
    public function getAddresses(): ArrayCollection
    {
        return $this->addresses;
    }

    /**
     * Set CompanyEntity Addresses
     */
    public function setAddresses(ArrayCollection|array|null $addresses): self
    {
        $addresses = Utils::createArrayCollection($addresses);

        $this->addresses = $addresses;

        return $this;
    }

    /**
     * Check if CompanyEntity has valid Addresses
     */
    public function hasAddresses(): bool
    {
        $addresses = $this->getAddresses();

        if (!$addresses instanceof ArrayCollection || $addresses->isEmpty()) {
            return false;
        }

        // Check if all elements are Addresses
        foreach ($addresses->toArray() as $address) {
            if (!$address instanceof Address) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get HR Mail Address for the given City
     */
    public function getHrMailAddressByCity(int|string $cityId): ?string
    {
        $addresses = $this->getAddresses();

        foreach ($addresses->toArray() as $address) {
            if ((int) $cityId === $address->getCityId()) {
                return $address->getHrMailAddress();
            }
        }

        return null;
    }

    /**
     * Get number of CompanyEntity Offices
     */
    public function getOfficesNumber(): ?int
    {
        return $this->officesNumber;
    }

    /**
     * Set number of CompanyEntity Offices
     */
    public function setOfficesNumber(?int $officesNumber): self
    {
        $this->officesNumber = $officesNumber;

        return $this;
    }

    /**
     * Check if CompanyEntity has Offices
     */
    public function hasOffices(): bool
    {
        $officesNumber = $this->getOfficesNumber();

        return is_int($officesNumber) && $officesNumber > 0;
    }
}
