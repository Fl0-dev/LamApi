<?php

namespace App\Entity\Subscriptions\Applicant\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Company\CompanyGroup;
use App\Repository\SubscriptionRepositories\Applicant\CompanyGroupResultRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyGroupResultRepository::class)]
#[ApiResource]
class CompanyGroupResult
{
    use Uuid;
    
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyGroup $companyGroup = null;

    #[ORM\ManyToOne(inversedBy: 'companyGroupResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantLamatch $applicantLamatch = null;

    #[ORM\Column]
    private ?int $matchingPercentage = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getApplicantLamatch(): ?ApplicantLamatch
    {
        return $this->applicantLamatch;
    }

    public function setApplicantLamatch(?ApplicantLamatch $applicantLamatch): self
    {
        $this->applicantLamatch = $applicantLamatch;

        return $this;
    }

    public function getMatchingPercentage(): ?int
    {
        return $this->matchingPercentage;
    }

    public function setMatchingPercentage(int $matchingPercentage): self
    {
        $this->matchingPercentage = $matchingPercentage;

        return $this;
    }
}
