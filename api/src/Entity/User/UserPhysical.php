<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Applicant\Applicant;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "admin" => "UserAdmin",
    "applicant" => Applicant::class,
    "employer" => "Employer",
])]
#[ORM\Entity]
#[ORM\Table(name: "physical_user")]
#[ApiResource()]
class UserPhysical extends User
{
    #[ORM\Column(type: "string", length: 180)]
    #[Groups(['write:postApplicationByOfferId'])]
    private $firstname;

    #[ORM\Column(type: "string", length: 180)]
    #[Groups(['write:postApplicationByOfferId'])]
    private $lastname;

    #[ORM\Column(type: "string", length: 180)]
    #[Groups(['write:postApplicationByOfferId'])]
    private $email;

    #[ORM\Column(type: "date", nullable: true)]
    private $birthdate;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }
}
