<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Media\Media;
use App\Repository\Company\CompanyEntityHasMediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyEntityHasMediaRepository::class)]
#[ApiResource]
class CompanyEntityHasMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'companyEntityMedias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyEntity $companyEntity = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?Media $media = null;

    public function getId(): ?int
    {
        return $this->id;
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
