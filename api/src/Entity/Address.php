<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ApiResource()]
class Address
{
    use Uuid;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:getOfferDetails', 'read:getAllCompanyGroups', 'read:getAllTeaserCompanyGroups'])]
    private $street;

    #[ORM\Column(type: 'string', length: 10)]
    #[Groups(['read:getOfferDetails', 'read:getAllCompanyGroups','read:getAllTeaserCompanyGroups'])]
    private $postalCode;

    #[ORM\Column(type: 'float')]
    #[Groups(['read:getOfferDetails','read:getAllTeaserCompanyGroups'])]
    private $latitude;

    #[ORM\Column(type: 'float')]
    #[Groups(['read:getOfferDetails','read:getAllTeaserCompanyGroups'])]
    private $longitude;

    #[ORM\Column(type: 'string', length: 255)]
    private $hrMailAddress;

    #[ORM\ManyToOne(targetEntity: City::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:getOfferDetails', 'read:getAllCompanyGroups', 'read:getAllTeaserOffers','read:getAllTeaserCompanyGroups'])]
    private $city;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getHrMailAddress(): ?string
    {
        return $this->hrMailAddress;
    }

    public function setHrMailAddress(string $hrMailAddress): self
    {
        $this->hrMailAddress = $hrMailAddress;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
