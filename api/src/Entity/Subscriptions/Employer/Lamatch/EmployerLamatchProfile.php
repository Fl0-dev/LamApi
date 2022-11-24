<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\PostEmployerLamatchProfile;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyProfile;
use App\Entity\JobTitle;
use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchProfileRepository;
use App\Transversal\Label;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmployerLamatchProfileRepository::class)]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(
        security: "is_granted('ROLE_EMPLOYER')",
        controller: PostEmployerLamatchProfile::class,
        uriTemplate: '/employer/lamatch/profiles',
        openapiContext: [
            'summary' => 'Create a new profile',
            'description' => 'Create a new profile',
        ]
    ),
    new Patch(),
    new Delete(),
])]
class EmployerLamatchProfile
{
    use TechnicalProperties;
    use Label;
    public const OPERATION_NAME_POST_EMPLOYER_LAMATCH_PROFILE = 'post_employer_lamatch_profile';

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([self::OPERATION_NAME_POST_EMPLOYER_LAMATCH_PROFILE])]
    private ?string $experience = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([self::OPERATION_NAME_POST_EMPLOYER_LAMATCH_PROFILE])]
    private ?string $levelOfStudy = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::OPERATION_NAME_POST_EMPLOYER_LAMATCH_PROFILE])]
    private ?JobTitle $jobTitle = null;

    #[ORM\ManyToOne]
    private ?CompanyEntityOffice $companyEntityOffice = null;

    #[ORM\ManyToOne]
    private ?CompanyProfile $companyProfile = null;

    #[ORM\ManyToOne]
    #[Groups([self::OPERATION_NAME_POST_EMPLOYER_LAMATCH_PROFILE])]
    private ?DISCPersonality $personality = null;

    #[ORM\ManyToOne(inversedBy: 'employerLamatchProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatchSubscription $employerLamatchSubscription = null;

    #[ORM\Column(length: 50)]
    private string $status;

    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->lastModifiedDate = new \DateTime();
        $this->setStatus((new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId());
    }


    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getLevelOfStudy(): ?string
    {
        return $this->levelOfStudy;
    }

    public function setLevelOfStudy(?string $levelOfStudy): self
    {
        $this->levelOfStudy = $levelOfStudy;

        return $this;
    }

    public function getJobTitle(): ?JobTitle
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?JobTitle $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getCompanyEntityOffice(): ?CompanyEntityOffice
    {
        return $this->companyEntityOffice;
    }

    public function setCompanyEntityOffice(?CompanyEntityOffice $companyEntityOffice): self
    {
        $this->companyEntityOffice = $companyEntityOffice;

        return $this;
    }

    public function getCompanyProfile(): ?CompanyProfile
    {
        return $this->companyProfile;
    }

    public function setCompanyProfile(?CompanyProfile $companyProfile): self
    {
        $this->companyProfile = $companyProfile;

        return $this;
    }

    public function getPersonality(): ?DISCPersonality
    {
        return $this->personality;
    }

    public function setPersonality(?DISCPersonality $personality): self
    {
        $this->personality = $personality;

        return $this;
    }

    public function getEmployerLamatchSubscription(): ?EmployerLamatchSubscription
    {
        return $this->employerLamatchSubscription;
    }

    public function setEmployerLamatchSubscription(?EmployerLamatchSubscription $employerLamatchSubscription): self
    {
        $this->employerLamatchSubscription = $employerLamatchSubscription;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
