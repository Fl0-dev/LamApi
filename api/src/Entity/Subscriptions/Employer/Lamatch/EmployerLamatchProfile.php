<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyProfile;
use App\Entity\JobTitle;
use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Entity\Subscriptions\MainValue;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchProfileRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerLamatchProfileRepository::class)]
#[ApiResource]
class EmployerLamatchProfile
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

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

    #[ORM\ManyToOne]
    private ?MainValue $mainValue = null;

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

    public function getMainValue(): ?MainValue
    {
        return $this->mainValue;
    }

    public function setMainValue(?MainValue $mainValue): self
    {
        $this->mainValue = $mainValue;

        return $this;
    }
}
