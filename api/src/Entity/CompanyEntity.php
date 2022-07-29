<?php

namespace App\Entity;

use App\Repository\CompanyEntityRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyEntityRepository::class)]
class CompanyEntity
{
    use Uuid;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hrMail;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $officeNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    public function getHrMail(): ?string
    {
        return $this->hrMail;
    }

    public function setHrMail(?string $hrMail): self
    {
        $this->hrMail = $hrMail;

        return $this;
    }

    public function getOfficeNumber(): ?int
    {
        return $this->officeNumber;
    }

    public function setOfficeNumber(?int $officeNumber): self
    {
        $this->officeNumber = $officeNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
