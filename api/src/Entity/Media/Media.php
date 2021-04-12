<?php

namespace App\Entity\Media;

use App\Utils\Utils;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Trait\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ApiResource(
 *     iri="http://schema.org/MediaObject",
 *     normalizationContext={
 *         "groups"={"media_object_read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateMediaObjectAction::class,
 *             "deserialize"=false,
 *             "security"="is_granted('ROLE_USER')",
 *             "validation_groups"={"Default", "media_object_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @Vich\Uploadable
 */
class Media extends File
{
    use Uuid;
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"media_object_read"})
     */
    private $contentUrl;

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"media_object_create"})
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    private $file;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     */
    private $filePath;

    /**
     * Media Type (img or video)
     *
     * @var string
     */
    private $type;

    /**
     * Media alt attribute
     *
     * @var string
     */
    private $alt;

    /**
     * Media Constructor
     *
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->setFilePath($filePath);
    }

    /**
     * Check if this Media is an image
     *
     * @return bool
     */
    public function isImage()
    {
        return self::TYPE_IMAGE === $this->getType();
    }

    /**
     * Check if this Media is a video
     *
     * @return bool
     */
    public function isVideo()
    {
        return self::TYPE_VIDEO === $this->getType();
    }

    /**
     * Get the value of type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param string $type Media type
     *
     * @return self
     */
    public function setType($type)
    {
        if (in_array($type, [self::TYPE_IMAGE, self::TYPE_VIDEO])) {
            $this->type = $type;
        }

        return $this;
    }

    /**
     * Set type on Image
     *
     * @return self
     */
    public function setTypeImage()
    {
        $this->type = self::TYPE_IMAGE;

        return $this;
    }

    /**
     * Set type on Video
     *
     * @return self
     */
    public function setTypeVideo()
    {
        $this->type = self::TYPE_VIDEO;

        return $this;
    }

    /**
     * Get the value of src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set the value of src
     *
     * @param string $src Media URI
     *
     * @return self
     */
    public function setFilePath($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Check if Media has a src value
     *
     * @return bool
     */
    public function hasSrc()
    {
        return Utils::isUrl($this->getSrc());
    }

    /**
     * Get media alt attribute
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set media alt attribute
     *
     * @param string|null $alt Media alt attribute
     *
     * @return self
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }
}
