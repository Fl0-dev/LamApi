<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Media\MediaImage;
use App\Entity\User\UserAbstract;
use App\Repository\AtsRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtsRepository::class)]
#[ApiResource()]
class Ats
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $free;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MediaImage $logo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?UserAbstract $abstractUser = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

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
