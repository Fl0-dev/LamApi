<?php

namespace App\Entity;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use App\Entity\Company\CompanyGroup;
use App\Repository\SocialRepository;
use App\Transversal\Uuid;
use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource]
#[ORM\Entity(repositoryClass: SocialRepository::class)]
class Social
{
    use Uuid;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $linkedin;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $twitter;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $facebook;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $instagram;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $youtube;
    /**
     * Social Constructor
     */
    public function __construct()
    {
    }
    public function getLinkedin() : ?string
    {
        return $this->linkedin;
    }
    /**
     * Set the LinkedIn URL
     */
    public function setLinkedin(?string $linkedin) : self
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
    public function hasLinkedin() : bool
    {
        return Utils::isUrl($this->getLinkedin());
    }
    public function getTwitter() : ?string
    {
        return $this->twitter;
    }
    /**
     * Set the Twitter URL
     */
    public function setTwitter(?string $twitter) : self
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
    public function hasTwitter() : bool
    {
        return Utils::isUrl($this->getTwitter());
    }
    public function getFacebook() : ?string
    {
        return $this->facebook;
    }
    /**
     * Set the Facebook URL
     */
    public function setFacebook(?string $facebook) : self
    {
        $this->facebook = $facebook;
        return $this;
    }
    public function getInstagram() : ?string
    {
        return $this->instagram;
    }
    /**
     * Set the Instagram URL
     */
    public function setInstagram(?string $instagram) : self
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
    public function hasInstagram() : bool
    {
        return Utils::isUrl($this->getInstagram());
    }
    public function getYoutube() : ?string
    {
        return $this->youtube;
    }
    /**
     * Set the Youtube URL
     */
    public function setYoutube(?string $youtube) : self
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
    public static function cleanSocialUrl(?string $url) : string
    {
        if (!is_string($url)) {
            return null;
        }
        $url = rtrim($url, '/');
        // Remove trailing slashes
        return $url;
    }
}
