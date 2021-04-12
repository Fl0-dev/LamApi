<?php

namespace App\Entity;

use App\Entity\Company\Group\CompanyGroup;
use App\Repository\ParrainRepository;
use App\Entity\Media\Image;
use App\Utils\Utils;

class Parrain extends ParrainRepository
{
    /**
     * Parrain ID (equals WP_Post ID)
     *
     * @var int
     */
    private $id;

    /**
     * Parrain Code
     *
     * @var string
     */
    private $code;

    /**
     * Parrain Name
     *
     * @var string
     */
    private $name;

    /**
     * Parrain Logo
     *
     * @var Image
     */
    private $logo;

    /**
     * Parrain Website
     *
     * @var string
     */
    private $website;

    /**
     * Parrain Contructor
     */
    public function __construct()
    {
    }

    /**
     * Generate a Code Parrain
     *
     * @param CompanyGroup $company
     *
     * @return string
     */
    public static function generateCodeParrain($company = null)
    {
        $codeParrain = 'NEWCOMPANY' . time();

        if ($company instanceof CompanyGroup && $company->hasName()) {
            $codeParrain = preg_replace("/[^a-zA-Z]/", '', $company->getName());
            $codeParrain = substr($codeParrain, 0, 10);
            $codeParrain = strtoupper($codeParrain);
            $codeParrain .= mt_rand(1000, 9999);
        }

        return $codeParrain;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id Parrain ID
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * Check if Parrain has a valid ID value
     *
     * @return bool
     */
    public function hasId()
    {
        $id = $this->getId();

        return is_int($id) && $id > 0;
    }

    /**
     * Get Parrain code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set Parrain code
     *
     * @param string $code Parrain code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get Parrain name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Parrain name
     *
     * @param string $name Parrain name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Parrain logo
     *
     * @return Image
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set Parrain logo
     *
     * @param Image $logo Parrain logo
     *
     * @return self
     */
    public function setLogo($logo)
    {
        if ($logo instanceof Image) {
            $this->logo = $logo;
        }

        return $this;
    }

    /**
     * Check if Parrain has a logo
     *
     * @return bool
     */
    public function hasLogo()
    {
        $logo = $this->getLogo();

        return ($logo instanceof Image && $logo->hasSrc());
    }

    /**
     * Get company website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set company website
     *
     * @param string $website CompanyEntity website
     *
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Check if CompanyEntity has a website
     *
     * @return bool
     */
    public function hasWebsite()
    {
        return Utils::isUrl($this->getWebsite());
    }
}
