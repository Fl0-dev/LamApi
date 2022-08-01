<?php

namespace App\Entity;

use App\Repository\CompanyGroupTeamRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyGroupTeamRepository::class)]
class CompanyGroupTeam
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: 'companyGroupTeams')]
    private $companyGroup;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }
}
