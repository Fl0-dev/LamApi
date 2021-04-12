<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Media;
use App\Entity\Media\Image as MediaImage;
use App\Entity\Media\Video as MediaVideo;
use App\Trait\UseUuid;
use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company Tool
 *
 * @ORM\Entity
 */
#[ApiResource]
class Tool
{
    use UseUuid;

    /**
     * Name
     *
     * @ORM\Column(type="string")
     */
    #[Assert\NotBlank]
    private ?string $name = null;

    /**
     * Logo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media\Image")
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id")
     */
    private ?MediaImage $logo = null;

    /**
     * URL
     *
     * @ORM\Column(type="string")
     */
    private ?string $url = null;

    /**
     * Description
     *
     * @ORM\Column(type="string")
     */
    private ?string $description = null;

    /**
     * Media (image or video) of the header page Tool
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media")
     * @ORM\JoinColumn(name="header_media_id", referencedColumnName="id")
     */
    private MediaImage|MediaVideo|null $headerMedia;

    /**
     * Constructor
     */
    public function __construct(?string $name = null, ?MediaImage $logo = null)
    {
        $this->name = $name;
        $this->setLogo($logo);
    }

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of logo
     */
    public function getLogo(): ?MediaImage
    {
        return $this->logo;
    }

    /**
     * Set Logo
     */
    public function setLogo(?MediaImage $logo): self
    {
        if ($logo instanceof MediaImage || is_null($logo)) {
            $this->logo = $logo;
        }

        return $this;
    }

    /**
     * Check if has a valid logo
     */
    public function hasLogo(): bool
    {
        $logo = $this->getLogo();

        return $logo instanceof MediaImage && $logo->hasSrc();
    }

    /**
     * Get URL
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set URL
     */
    public function setUrl(?string $url): self
    {
        if (Utils::isUrl($url) || is_null($url)) {
            $this->url = $url;
        }

        return $this;
    }

    /**
     * Check if has a valid URL
     */
    public function hasUrl(): bool
    {
        return Utils::isUrl($this->getUrl());
    }

    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): self
    {
        $this->description = trim($description);

        return $this;
    }

    /**
     * Check if has a valid Description
     */
    public function hasDescription(): bool
    {
        $description = $this->getDescription();

        return is_string($description) && strlen($description) > 0;
    }

    /**
     * Get media (image or video) of the header page Tool
     */
    public function getHeaderMedia(): MediaImage|MediaVideo|null
    {
        return $this->headerMedia;
    }

    /**
     * Set media (image or video) of the header page Tool
     */
    public function setHeaderMedia(MediaImage|MediaVideo|null $headerMedia): self
    {
        $this->headerMedia = $headerMedia;

        return $this;
    }

    /**
     * Check if the has a valid Header Media
     */
    public function hasHeaderMedia(): bool
    {
        $headerMedia = $this->getHeaderMedia();

        return $headerMedia instanceof Media && $headerMedia->hasSrc();
    }
}
