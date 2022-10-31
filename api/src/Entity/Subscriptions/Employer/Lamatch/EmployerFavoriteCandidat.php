<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\User\Employer;
use App\Repository\Subscriptions\Employer\Lamatch\EmployerFavoriteCandidatRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerFavoriteCandidatRepository::class)]
#[ApiResource]
class EmployerFavoriteCandidat
{
    use Uuid;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantResult $applicantResult = null;

    #[ORM\ManyToOne(inversedBy: 'employerFavoriteCandidats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employer $employer = null;

    public function getApplicantResult(): ?ApplicantResult
    {
        return $this->applicantResult;
    }

    public function setApplicantResult(ApplicantResult $applicantResult): self
    {
        $this->applicantResult = $applicantResult;

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
