<?php

namespace App\Entity;

use App\Trait\Uuid;
use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;

/**
 * Social
 *
 * @ORM\Entity
 */
class Social
{
    use Uuid;

    /**
     * LinkedIn URL
     *
     * @ORM\Column(type="string")
     */
    private ?string $linkedin = null;

    /**
     * Twitter URL
     *
     * @ORM\Column(type="string")
     */
    private ?string $twitter = null;

    /**
     * Facebook URL
     *
     * @ORM\Column(type="string")
     */
    private ?string $facebook = null;

    /**
     * Instagram URL
     *
     * @ORM\Column(type="string")
     */
    private ?string $instagram = null;

    /**
     * Youtube URL
     *
     * @ORM\Column(type="string")
     */
    private ?string $youtube = null;

    /**
     * Social Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get the LinkedIn URL
     */
    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    /**
     * Set the LinkedIn URL
     */
    public function setLinkedin(?string $linkedin): self
    {
         $linkedin = self::cleanSocialUrl($linkedin);

         if (Utils::isUrl($linkedin) || is_null($linkedin)) {
             $this->linkedin = $linkedin;
         }

        return $this;
    }

    /**
     * Check if has a valid Linkedin URL
     */
    public function hasLinkedin(): bool
    {
        return Utils::isUrl($this->getLinkedin());
    }

    /**
     * Get the Twitter URL
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * Set the Twitter URL
     */
    public function setTwitter(?string $twitter): self
    {
        $twitter = self::cleanSocialUrl($twitter);

        if (Utils::isUrl($twitter) || is_null($twitter)) {
            $this->twitter = $twitter;
        }

        return $this;
    }

    /**
     * Check if has a valid Twitter URL
     */
    public function hasTwitter(): bool
    {
        return Utils::isUrl($this->getTwitter());
    }

    /**
     * Get the Facebook URL
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * Set the Facebook URL
     */
    public function setFacebook(?string $facebook): self
    {
        $facebook = self::cleanSocialUrl($facebook);

        if (Utils::isUrl($facebook) || is_null($facebook)) {
            $this->facebook = $facebook;
        }

        return $this;
    }

    /**
     * Check if has Facebook URL
     */
    public function hasFacebook(): bool
    {
        return Utils::isUrl($this->getFacebook());
    }

    /**
     * Get the Instagram URL
     */
    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    /**
     * Set the Instagram URL
     */
    public function setInstagram(?string $instagram): self
    {
        $instagram = self::cleanSocialUrl($instagram);

        if (Utils::isUrl($instagram) || is_null($instagram)) {
            $this->instagram = $instagram;
        }

        return $this;
    }

    /**
     * Check if has a valid Instagram URL
     */
    public function hasInstagram(): bool
    {
        return Utils::isUrl($this->getInstagram());
    }

    /**
     * Get the Youtube URL
     */
    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    /**
     * Set the Youtube URL
     */
    public function setYoutube(?string $youtube): self
    {
        $youtube = self::cleanSocialUrl($youtube);

        if (Utils::isUrl($youtube) || is_null($youtube)) {
            $this->youtube = $youtube;
        }

        return $this;
    }

    /**
     * Check if has Youtube URL
     */
    public function hasYoutube()
    {
        $youtube = $this->getYoutube();

        return Utils::isUrl($youtube);
    }

    /**
     * Clean Social URL
     */
    public static function cleanSocialUrl(?string $url): string
    {
        if (!is_string($url)) return null;

        $url = rtrim($url, '/'); // Remove trailing slashes

        return $url;
    }
}
