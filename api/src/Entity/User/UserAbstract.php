<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    self::TYPE_JOB_BOARD => UserJobBoard::class,
    self::TYPE_ATS => UserAts::class,
])]
#[ORM\Entity]
#[ORM\Table(name: "abstract_user")]
abstract class UserAbstract extends User
{
    const TYPE_JOB_BOARD = "jobBoard";
    const TYPE_ATS = "ats";

    #[ORM\Column(type: "string", length: 180)]
    private $name;

    #[ORM\Column(type: "string", length: 180)]
    private $slug;

    #[ORM\Column(type: "string", length: 180)]
    private $contactEmail;

    #[ORM\Column(type: "string", length: 180)]
    private $contactPhone;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $tokenLocal;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $tokenQualification;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $tokenProduction;

    public function __construct()
    {
        parent::__construct();
    }

    public function getType(): string
    {
        return self::TYPE_ABSTRACT;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of contactEmail
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set the value of contactEmail
     *
     * @return  self
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get the value of contactPhone
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set the value of contactPhone
     *
     * @return  self
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getTokenLocal()
    {
        return $this->tokenLocal;
    }

    public function setTokenLocal($tokenLocal)
    {
        $this->tokenLocal = $tokenLocal;

        return $this;
    }

    public function getTokenQualification()
    {
        return $this->tokenQualification;
    }

    public function setTokenQualification($tokenQualification)
    {
        $this->tokenQualification = $tokenQualification;

        return $this;
    }

    public function getTokenProduction()
    {
        return $this->tokenProduction;
    }

    public function setTokenProduction($tokenProduction)
    {
        $this->tokenProduction = $tokenProduction;

        return $this;
    }
}
