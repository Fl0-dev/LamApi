<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Media\Media;
use App\Repository\Company\CompanyGroupHasMediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
    private ?CompanyGroup $companyGroup = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?Media $media = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroupId = $companyGroup;

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
