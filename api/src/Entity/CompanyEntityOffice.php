<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyEntityOfficeRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyEntityOfficeRepository::class)]
#[ApiResource]
class CompanyEntityOffice
{
    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'companyEntityOffices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyEntity $companyEntity = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

        return $this;
    }


}
