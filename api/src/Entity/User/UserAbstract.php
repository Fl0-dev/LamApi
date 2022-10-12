<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["api" => UserApi::class])]
#[ORM\Entity]
#[ORM\Table(name: "abstract_user")]
abstract class UserAbstract extends User
{
    public const TYPE_API = "api";

    #[ORM\Column(type: "string", length: 180)]
    private $name;

    #[ORM\Column(type: "string", length: 180)]
    private $slug;

    #[ORM\Column(type: "string", length: 180)]
    private $contactEmail;

    #[ORM\Column(type: "string", length: 180)]
    private $contactPhone;

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
}
