<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Entity\Application\Application;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "admin" => UserAdmin::class,
    "applicant" => Applicant::class,
    "employer" => Employer::class,
])]
#[ORM\Entity]
#[ORM\Table(name: "physical_user")]
#[ApiResource()]
class UserPhysical extends User
{
    const TYPE_ADMIN = "admin";
    const TYPE_APPLICANT = "applicant";
    const TYPE_EMPLOYER = "employer";

    #[ORM\Column(type: "string", length: 180)]
    #[Groups([Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID])]
    private $firstname;

    #[ORM\Column(type: "string", length: 180)]
    #[Groups([Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID])]
    private $lastname;

    #[ORM\Column(type: "date", nullable: true)]
    private $birthdate;

    public function __construct()
    {
        parent::__construct();
    }

    public function getType(): string
    {
        return self::TYPE_PHYSICAL;
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
