<?php

namespace App\Entity\Company\CompanyEntity;

use App\Entity\Localisation\Address;
use App\Entity\Media;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Localisation\Address")
     * @ORM\JoinTable(name="company_entity_offices_addresses",
     *      joinColumns={@JoinColumn(name="company_entity_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="address_id", referencedColumnName="id")}
     * )
     */
    private iterable $addresses;

    /**
     * Number of CompanyEntity Offices
     *
     * @ORM\Column(type="integer")
     */
    private ?int $officesNumber = null;

    /**
     * List of medias present CompanyEntity offices
     *
     * @var ArrayCollection<Media>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Media")
     * @ORM\JoinTable(name="company_entity_offices_medias",
     *      joinColumns={@JoinColumn(name="company_entity_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="media_id", referencedColumnName="id")}
     * )
     */
    private iterable $officesMedias;

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

    /**
     * Get list of medias present CompanyEntity offices
     */
    public function getOfficesMedias(): ArrayCollection
    {
        return $this->officesMedias;
    }

    /**
     * Set list of medias which present CompanyEntity Offices
     */
    public function setOfficesMedias(ArrayCollection|array|null $officesMedias): self
    {
        $officesMedias = Utils::createArrayCollection($officesMedias);

        $this->officesMedias = $officesMedias;

        return $this;
    }

    /**
     * Check if CompanyEntity has Offices Medias
     */
    public function hasOfficesMedias(): bool
    {
        $officesMedias = $this->getOfficesMedias();

        if (
            !($officesMedias instanceof ArrayCollection)
            || $officesMedias->isEmpty()
            || !$this->areOfficesMedias($officesMedias)
        ) {
            return false;
        }

        return true;
    }

    /**
     * Check if given Office media is a valid Office media
     */
    public function isOfficeMedia(object $officeMedia): bool
    {
        return (is_object($officeMedia)
            && property_exists($officeMedia, 'media')
            && property_exists($officeMedia, 'caption'));
    }

    /**
     * Check if given Offices medias are all valid Offices Medias
     */
    public function areOfficesMedias(ArrayCollection|array $officesMedias): bool
    {
        if ($officesMedias instanceof ArrayCollection) {
            $officesMedias = $officesMedias->toArray();
        }

        if (!is_array($officesMedias)) {
            return false;
        }

        foreach ($officesMedias as $officeMedia) {
            if (!$this->isOfficeMedia($officeMedia)) {
                return false;
            }
        }

        return true;
    }
}
