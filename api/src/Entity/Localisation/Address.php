<?php

namespace App\Entity\Localisation;

use App\Trait\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Entity
 */
class Address
{
    use Uuid;

    /**
     * Name
     *
     * @ORM\Column(type="string", length=50)
     */
    private ?string $name = null;

    /**
     * Street
     *
     * @ORM\Column(type="string", length=255)
     */
    private ?string $street = null;

    /**
     * City
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation\City")
     */
    private $city;

    /**
     * Postal Code
     *
     * @ORM\Column(type="string", length=10)
     */
    private ?string $postalCode = null;

    /**
     * HR Mail Address
     *
     * @ORM\Column(type="string", length=255)
     */
    private ?string $hrMailAddress = null;

    /**
     * Latitude
     *
     * @ORM\Column(type="float")
     */
    private ?float $latitude = null;

    /**
     * Longitude
     *
     * @ORM\Column(type="float")
     */
    private ?float $longitude = null;

    /**
     * Address Constructor
     */
    public function __construct(
        ?string $name = null,
        ?string $street = null,
        ?City $city = null,
        ?string $postalCode = null,
        ?string $hrMailAddress = null,
        ?float $latitude = null,
        ?float $longitude = null
    ) {
        $this->setName($name);
        $this->setStreet($street);
        $this->setCity($city);
        $this->setPostalCode($postalCode);
        $this->setHrMailAddress($hrMailAddress);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /**
     * Get the Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the Name
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
     * Get the Street
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Set the Street
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Check if has a valid Street
     */
    public function hasStreet(): bool
    {
        $street = $this->getStreet();

        return is_string($street) && strlen($street) > 0;
    }

    /**
     * Get the City
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * Get the City Name
     */
    public function getCityName(): ?string
    {
        if ($this->hasCity()) {
            return $this->getCity()->getName();
        }

        return null;
    }

    /**
     * Get the City Full Name (with Department Code)
     */
    public function getCityFullName(): ?string
    {
        if ($this->hasCity()) {
            return $this->getCity()->getFullName();
        }

        return null;
    }

    /**
     * Set the City
     */
    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Check if has a valid City
     */
    public function hasCity()
    {
        return $this->getCity() instanceof City;
    }

    /**
     * Get the Postal Code
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Set the Postal Code
     */
    public function setPostalCode(?string $postalCode): self
    {
        if ($this->isPostalCode($postalCode) || is_null($postalCode)) {
            $this->postalCode = $postalCode;
        }

        return $this;
    }

    /**
     * Check if has a valid Postal Code
     */
    public function hasPostalCode(): bool
    {
        return $this->isPostalCode($this->getPostalCode());
    }

    /**
     * Check if given Postal Code is valid
     */
    public function isPostalCode(mixed $postalCode): bool
    {
        return is_string($postalCode)
            && strlen($postalCode) > 0
            && is_int((int) $postalCode);
    }

    /**
     * Get the HR Mail Address
     */
    public function getHrMailAddress(): ?string
    {
        return $this->hrMailAddress;
    }

    /**
     * Set the HR Mail Address
     */
    public function setHrMailAddress(?string $hrMailAddress): self
    {
        if ($this->isHrMailAddress($hrMailAddress) || is_null($hrMailAddress)) {
            $this->hrMailAddress = $hrMailAddress;
        }

        return $this;
    }

    /**
     * Check if has a valid HR Mail Address
     */
    public function hasHrMailAddress(): bool
    {
        return $this->isHrMailAddress($this->getHrMailAddress());
    }

    /**
     * Check if given HR Mail Address is valid
     */
    public function isHrMailAddress(mixed $hrMailAddress): bool
    {
        return is_string($hrMailAddress) && filter_var($hrMailAddress, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Get the Latitude
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * Set the Latitude
     */
    public function setLatitude(?float $latitude): self
    {
        if ($this->isLatitude($latitude) || is_null($latitude)) {
            $this->latitude = $latitude;
        }

        return $this;
    }

    /**
     * Check if has a valid Latitude
     */
    public function hasLatitude(): bool
    {
        return $this->isLatitude($this->getLatitude());
    }

    /**
     * Check if the given Latitude is valid
     */
    public function isLatitude(mixed $latitude): bool
    {
        return is_float($latitude)
            && 0.0 !== $latitude
            && -90 <= $latitude
            && 90 >= $latitude;
    }

    /**
     * Get the Longitude
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * Set the Longitude
     */
    public function setLongitude(?float $longitude): self
    {
        if ($this->isLongitude($longitude) || is_null($longitude)) {
            $this->longitude = $longitude;
        }

        return $this;
    }

    /**
     * Check if has a valid Longitude
     */
    public function hasLongitude(): bool
    {
        return $this->isLongitude($this->getLongitude());
    }

    /**
     * Check if the given Longitude is valid
     */
    public function isLongitude(mixed $longitude): bool
    {
        return is_float($longitude)
            && 0.0 !== $longitude
            && -180 <= $longitude
            && 180 >= $longitude;
    }

    /**
     * Check if has valid Coordinates (Latitude and Longitude)
     */
    public function hasCoordinates(): bool
    {
        return $this->hasLatitude() && $this->hasLongitude();
    }
}
