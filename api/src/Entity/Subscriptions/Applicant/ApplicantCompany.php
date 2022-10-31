<?php

namespace App\Entity\Subscriptions\Applicant;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Company\CompanyGroup;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantCompanyRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantCompanyRepository::class)]
#[ApiResource]
class ApplicantCompany
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column]
    private ?bool $activeSending = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyGroup $companyGroup = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantCompanySubscription $applicantCompanySubscription = null;

    public function isActiveSending(): ?bool
    {
        return $this->activeSending;
    }

    public function setActiveSending(bool $activeSending): self
    {
        $this->activeSending = $activeSending;

        return $this;
    }

    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }

    public function getApplicantCompanySubscription(): ?ApplicantCompanySubscription
    {
        return $this->applicantCompanySubscription;
    }

    public function setApplicantCompanySubscription(?ApplicantCompanySubscription $applicantCompanySubscription): self
    {
        $this->applicantCompanySubscription = $applicantCompanySubscription;

        return $this;
    }
}
