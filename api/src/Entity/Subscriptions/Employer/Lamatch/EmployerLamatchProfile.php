<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyProfile;
use App\Entity\JobTitle;
use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchProfileRepository;
use App\Transversal\Label;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerLamatchProfileRepository::class)]
#[ApiResource]
class EmployerLamatchProfile
{
    use TechnicalProperties;
    use Label;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $experience = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $levelOfStudy = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?JobTitle $jobTitle = null;

    #[ORM\ManyToOne]
    private ?CompanyEntityOffice $companyEntityOffice = null;

    #[ORM\ManyToOne]
    private ?CompanyProfile $companyProfile = null;

    #[ORM\ManyToOne]
    private ?DISCPersonality $personnality = null;

    #[ORM\ManyToOne(inversedBy: 'employerLamatchProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatchSubscription $employerLamatchSubscription = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

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

    public function getPersonnality(): ?DISCPersonality
    {
        return $this->personnality;
    }

    public function setPersonnality(?DISCPersonality $personnality): self
    {
        $this->personnality = $personnality;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
