<?php

namespace App\Entity;

use App\Repository\CityRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 75)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $departmentNumber;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
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
