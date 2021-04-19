<?php

namespace App\Entity;

use App\Entity\Media\MediaImage;
use App\Trait\Uuid;
use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organisation (Partners...)
 *
 * @ORM\Entity
 */
class Organisation
{
    use Uuid;

    /**
     * Name
     *
     * @ORM\Column(type="string")
     */
    private ?string $name = null;

    /**
     * Logo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media\MediaImage")
     */
    private ?MediaImage $logo = null;

    /**
     * Organisation website
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $website = null;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set Name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Check if has a valid Name
     */
    public function hasName(): bool
    {
        $name = $this->getName();

        return is_string($name) && strlen($name) > 0;
    }

    /**
     * Get Logo
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
        $this->logo = $logo;

        return $this;
    }

    /**
     * Check if has a valid Logo
     */
    public function hasLogo(): bool
    {
        $logo = $this->getLogo();

        return $logo instanceof MediaImage && $logo->hasSrc();
    }

    /**
     * Get Website URL
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Set Website URL
     */
    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Check if has a valid Website URL
     */
    public function hasWebsite(): bool
    {
        return Utils::isUrl($this->getWebsite());
    }
}
