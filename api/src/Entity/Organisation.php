<?php

namespace App\Entity;

use App\Utils\Utils;

class Organisation
{
    /**
     * WP Post ID
     *
     * @var int
     */
    private $id;

    /**
     * Organisation name
     *
     * @var string
     */
    private $name;

    /**
     * Organisation logo
     */
    private $logo;

    /**
     * Organisation website
     *
     * @var string
     */
    private $website;

    public function __construct()
    {
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
     * @param int $id WP Post ID
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * Check if Organisation has a valid ID value
     *
     * @return bool
     */
    public function hasId()
    {
        $id = $this->getId();

        return is_int($id) && $id > 0;
    }

    /**
     * Get Organisation name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Organisation name
     *
     * @param string $name Organisation name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Organisation logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set Organisation logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get Organisation website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Check if has website
     *
     * @return bool
     */
    public function hasWebsite()
    {
        return Utils::isUrl($this->getWebsite());
    }

    /**
     * Set Organisation website
     *
     * @param string $website Organisation website
     *
     * @return self
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;

        return $this;
    }
}
