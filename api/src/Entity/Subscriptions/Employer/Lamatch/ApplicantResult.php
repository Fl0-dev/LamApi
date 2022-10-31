<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\ApplicantResultRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantResultRepository::class)]
#[ApiResource]
class ApplicantResult
{
    use Uuid;

    #[ORM\Column]
    private ?int $matchingPercentage = null;

    #[ORM\ManyToOne]
    private ?Applicant $applicant = null;

    #[ORM\ManyToOne(inversedBy: 'applicantResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatch $employerLamatch = null;

    public function getMatchingPercentage(): ?int
    {
        return $this->matchingPercentage;
    }

    public function setMatchingPercentage(int $matchingPercentage): self
    {
        $this->matchingPercentage = $matchingPercentage;

        return $this;
    }

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(?Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }

    public function getEmployerLamatch(): ?EmployerLamatch
    {
        return $this->employerLamatch;
    }

    public function setEmployerLamatch(?EmployerLamatch $employerLamatch): self
    {
        $this->employerLamatch = $employerLamatch;

        return $this;
    }

    public function getEmployer(): ?Employer
    {
        return $this->employer;
    }

    public function setEmployer(?Employer $employer): self
    {
        $this->employer = $employer;

        return $this;
    }
}
