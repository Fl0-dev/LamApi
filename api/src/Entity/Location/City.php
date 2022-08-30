<?php

namespace App\Entity\Location;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\LocationFilter;
use App\Repository\LocationRepositories\CityRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CityRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'method' => 'GET',
            'path' => '/cities',
            'normalization_context' => [
                'groups' => ['read:getAllCities'],
            ],
        ],
    ],
)]
#[ApiFilter(LocationFilter::class)]
class City
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 75)]
    #[Groups(["read:getAllCities", "read:getAllTeaserCompanyGroups", 'read:getCompanyGroupOffices'])]
    private $name;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:getAllCities", 'read:getCompanyGroupOffices'])]
    private $department;

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

    #[Groups(['read:getOfferDetails', 'read:getAllTeaserOffers','read:getAllTeaserCompanyGroups', 'read:getCompanyGroupOffices'])]
    public function getCityNameAndNbDepartment(): string
    {
        return $this->name . ' (' . $this->department->getDepartmentNumber() . ')';
    }
}
