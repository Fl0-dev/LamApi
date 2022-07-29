<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    use TechnicalProperties;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contentUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $filePath;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $alt;

    /**
     * @var File|null
     *
     */
    #[Assert\NotNull()]
    #[Groups(["media_object_create"])]
    #[Vich\UploadableField(mapping: "media_object", fileNameProperty: "filePath")]
    private ?File $file;

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(?string $contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }
}
