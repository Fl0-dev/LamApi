<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\GetLightCurrentApplicant;
use App\Entity\Applicant\Applicant;
use App\Entity\Application\Application;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new Get(
        security: "is_granted('ROLE_APPLICANT')",
        uriTemplate: '/applicant/{id}/light-infos',
        controller: GetLightCurrentApplicant::class,
        formats: ['json'],
        normalizationContext: ['groups' => [self::OPERATION_NAME_GET_LIGHT_APPLICANT_INFOS]],
        openapiContext: [
            'summary' => 'Get light applicant infos',
            'description' => 'Get light applicant infos',
            'tags' => ['Applicant'],
        ]
    ),
])]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    self::TYPE_ADMIN => UserAdmin::class,
    self::TYPE_APPLICANT => Applicant::class,
    self::TYPE_EMPLOYER => Employer::class
])]
#[ORM\Entity]
#[ORM\Table(name: "physical_user")]
abstract class UserPhysical extends User
{
    public const TYPE_ADMIN = "admin";
    public const TYPE_APPLICANT = "applicant";
    public const TYPE_EMPLOYER = "employer";
    public const OPERATION_NAME_GET_LIGHT_APPLICANT_INFOS = 'get_light_applicant_infos';

    #[ORM\Column(type: "string", length: 180, nullable: true)]
    #[Groups([
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        Application::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        Applicant::OPERATION_NAME_GET_ALL_APPLICANTS,
        Applicant::OPERATION_NAME_POST_APPLICANT,
        Applicant::OPERATION_NAME_GET_LIGHT_APPLICANT_INFOS,
        ApplicantLamatchProfile::OPERATION_NAME_GET_APPLICANT_LAMATCH_PROFILE_BY_CURRENT_APPLICANT,
    ])]
    private $firstname;

    #[ORM\Column(type: "string", length: 180, nullable: true)]
    #[Groups([
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        Application::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        Applicant::OPERATION_NAME_GET_ALL_APPLICANTS,
        Applicant::OPERATION_NAME_POST_APPLICANT,
        Applicant::OPERATION_NAME_GET_LIGHT_APPLICANT_INFOS,
        ApplicantLamatchProfile::OPERATION_NAME_GET_APPLICANT_LAMATCH_PROFILE_BY_CURRENT_APPLICANT,
    ])]
    private $lastname;

    #[ORM\Column(type: "date", nullable: true)]
    private $birthdate;

    public function __construct()
    {
        parent::__construct();
    }

    #[Groups([self::OPERATION_NAME_GET_USERS])]
    public function getType(): string
    {
        return self::TYPE_PHYSICAL;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

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
