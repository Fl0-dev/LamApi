<?php

namespace App\Entity\Media;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\CompanyEntity;
use App\Entity\Company\CompanyGroup;
use App\Repository\MediaRepositories\MediaRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 */
#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "image" => MediaImage::class,
    "video" => MediaVideo::class,
])]
#[ApiResource(
    normalizationContext: ["read:getMedia"],
    collectionOperations: [
        "get" => [
            "method" => "GET",
            "path" => "/media",
            "normalization_context" => [
                "groups" => ["read:getMedia"]
            ]
        ],
        "post" => [
            "method" => "POST",
            "path" => "/media",
            "normalization_context" => [
                "groups" => ["read:getMedia"]
            ]
        ]
    ]
)]
abstract class Media
{
    use TechnicalProperties;

    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getMedia'])]
    private $contentUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('read:getCompanyGroupDetails', 'read:getMedia')]
    private $filePath;

    /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    #[Assert\NotNull()]
    private ?File $file = null;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    #[Groups(['read:getMedia'])]
    private ?CompanyEntity $companyEntity = null;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['read:getMedia'])]
    private ?CompanyGroup $companyGroup = null;

    public function __construct()
    {
       if($this instanceof MediaImage) {
           $this->type = self::TYPE_IMAGE;
       } 

       if($this instanceof MediaVideo) {
           $this->type = self::TYPE_VIDEO;
       }
    }

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
        return self::TYPE_IMAGE === $this->getMediaType();
    }

    public function isVideo(): bool
    {
        return self::TYPE_VIDEO === $this->getMediaType();
    }

    #[Groups(['read:getMedia'])]
    public function getMediaType(): string
    {
        return get_class($this) === MediaImage::class ? self::TYPE_IMAGE : self::TYPE_VIDEO;
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

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

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
