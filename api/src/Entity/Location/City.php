<?php

namespace App\Entity\Location;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Company\CompanyGroup;
use App\Entity\Offer\Offer;
use App\Repository\LocationRepositories\CityRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid as BaseUuid;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new Get(),
    new Put(),
    new Patch(),
    new Delete(),
    new GetCollection(
        uriTemplate: '/cities',
        normalizationContext: ['groups' => ['getAllCities']]
    )
])]
#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    use Uuid;
    use Slug;

    public const OPERATION_NAME_GET_ALL_CITIES = 'getAllCities';

    #[ORM\Column(type: 'string', length: 75)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_CITIES,
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID
    ])]
    private $name;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_CITIES,
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID
    ])]
    private $department;

    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID
    ])]
    public function getCityNameAndDepartmentCode(): string
    {
        return $this->name . ' (' . $this->department->getCode() . ')';
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }
}
