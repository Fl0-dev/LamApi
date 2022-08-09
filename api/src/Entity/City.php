<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\LocalisationFilter;
use App\Repository\CityRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CityRepository::class)]
#[ApiResource(
    collectionOperations:
    [
        'get' => [
            'method' => 'GET',
            'path' => '/cities',
            'normalization_context' => [
                'groups' => ['read:getAllCities'],
            ],
        ],
    ],
)]
#[ApiFilter(LocalisationFilter::class)]
class City
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 75)]
    #[Groups(["read:getAllCompanyGroups", "read:getAllCities", "read:getAllTeaserOffers"])]
    private $name;

    #[ORM\Column(type: 'integer')]
    #[Groups(["read:getAllTeaserOffers"])]
    private $departmentNumber;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:getAllCompanyGroups", "read:getAllCities"])]
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

    public function getDepartmentNumber(): ?int
    {
        return $this->departmentNumber;
    }

    public function setDepartmentNumber(int $departmentNumber): self
    {
        $this->departmentNumber = $departmentNumber;

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
