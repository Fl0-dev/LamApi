<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "api" => UserApi::class,
])]
#[ORM\Entity]
#[ORM\Table(name: "abstract_user")]
#[ApiResource()]
abstract class UserAbstract extends User
{
    const TYPE_API = "api";

    #[ORM\Column(type: "string", length: 180)]
    private $name;

    #[ORM\Column(type: "string", length: 180)]
    private $slug;

    #[ORM\Column(type: "string", length: 180)]
    private $contact_email;

    #[ORM\Column(type: "string", length: 180)]
    private $contact_phone;

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
     * Get the value of contact_email
     */
    public function getContact_email()
    {
        return $this->contact_email;
    }

    /**
     * Set the value of contact_email
     *
     * @return  self
     */
    public function setContact_email($contact_email)
    {
        $this->contact_email = $contact_email;

        return $this;
    }

    /**
     * Get the value of contact_phone
     */
    public function getContact_phone()
    {
        return $this->contact_phone;
    }

    /**
     * Set the value of contact_phone
     *
     * @return  self
     */
    public function setContact_phone($contact_phone)
    {
        $this->contact_phone = $contact_phone;

        return $this;
    }
}
