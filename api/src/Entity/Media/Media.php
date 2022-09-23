<?php

namespace App\Entity\Media;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\CompanyEntity;
use App\Entity\Company\CompanyGroup;
use App\Entity\JobBoard;
use App\Entity\Offer\Offer;
use App\Repository\MediaRepositories\MediaRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
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
    normalizationContext: [self::OPERATION_NAME_GET_MEDIA],
    collectionOperations: [
        "get" => [
            "method" => "GET",
            "path" => "/media",
            "normalization_context" => [
                "groups" => [self::OPERATION_NAME_GET_MEDIA]
            ]
        ],
        "post" => [
            "method" => "POST",
            "path" => "/media",
            "normalization_context" => [
                "groups" => [self::OPERATION_NAME_GET_MEDIA]
            ]
        ]
    ]
)]
abstract class Media
{
    use TechnicalProperties;

    const OPERATION_NAME_GET_MEDIA = "getMedia";
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[ApiProperty(iri: 'https://schema.org/contentUrl')]
    #[Groups([self::OPERATION_NAME_GET_MEDIA])]
    private $contentUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_MEDIA,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
    ])]
    private $filePath;

    /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    private ?File $file = null;

    public function __construct(){}

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

    #[Groups([self::OPERATION_NAME_GET_MEDIA])]
    public function getMediaType(): string
    {
        return get_class($this) === MediaImage::class ? self::TYPE_IMAGE : self::TYPE_VIDEO;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }
}
