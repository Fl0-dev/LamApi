<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyGroupTeamMediaRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyGroupTeamMediaRepository::class)]
#[ApiResource()]
class CompanyGroupTeamMedia
{
    use Uuid;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $destination;

    #[ORM\ManyToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $media;

    #[ORM\ManyToOne(targetEntity: CompanyGroupTeam::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $companyGroupTeam;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getCompanyGroupTeam(): ?CompanyGroupTeam
    {
        return $this->companyGroupTeam;
    }

    public function setCompanyGroupTeam(?CompanyGroupTeam $companyGroupTeam): self
    {
        $this->companyGroupTeam = $companyGroupTeam;

        return $this;
    }
}
