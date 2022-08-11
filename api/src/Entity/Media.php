<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MediaRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "image" => "MediaImage",
    "video" => "MediaVideo"
])]
#[ApiResource()]
class Media
{
    use TechnicalProperties;

    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contentUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('read:getCompanyGroupDetails')]
    private $filePath;

    /**
     * @var File|null
     *
     */
    #[Assert\NotNull()]
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

    public function isImage(): bool
    {
        return self::TYPE_IMAGE === $this->getType();
    }

    public function isVideo(): bool
    {
        return self::TYPE_VIDEO === $this->getType();
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (in_array($type, [self::TYPE_IMAGE, self::TYPE_VIDEO])) {
            $this->type = $type;
        }

        return $this;
    }

    public function setTypeImage()
    {
        $this->type = self::TYPE_IMAGE;

        return $this;
    }

    public function setTypeVideo()
    {
        $this->type = self::TYPE_VIDEO;

        return $this;
    }

}
