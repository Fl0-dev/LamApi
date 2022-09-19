<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Media\Media;
use App\Repository\Company\CompanyGroupHasMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyGroupHasMediaRepository::class)]
#[ApiResource]
class CompanyGroupHasMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'companyGroupMedias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyGroup $companyGroupId = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Media $media = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyGroupId(): ?CompanyGroup
    {
        return $this->companyGroupId;
    }

    public function setCompanyGroupId(?CompanyGroup $companyGroupId): self
    {
        $this->companyGroupId = $companyGroupId;

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(Media $media): self
    {
        $this->media = $media;

        return $this;
    }
}
