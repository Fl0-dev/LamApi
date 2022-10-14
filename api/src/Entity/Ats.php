<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Media\MediaImage;
use App\Entity\User\UserAbstract;
use App\Repository\AtsRepository;
use App\Transversal\Slug;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: AtsRepository::class)]
class Ats extends UserAbstract
{
    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $free;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MediaImage $logo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?UserAbstract $abstractUser = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isFree(): ?bool
    {
        return $this->free;
    }

    public function setFree(bool $free): self
    {
        $this->free = $free;

        return $this;
    }

    public function getLogo(): ?MediaImage
    {
        return $this->logo;
    }

    public function setLogo(?MediaImage $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAbstractUser(): ?UserAbstract
    {
        return $this->abstractUser;
    }

    public function setAbstractUser(?UserAbstract $abstractUser): self
    {
        $this->abstractUser = $abstractUser;

        return $this;
    }
}
