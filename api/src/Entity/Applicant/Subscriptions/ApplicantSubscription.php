<?php

namespace App\Entity\Applicant\Subscriptions;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Repository\Applicant\Subscriptions\ApplicantSubscriptionRepository;
use App\Transversal\Label;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantSubscriptionRepository::class)]
#[ApiResource]
class ApplicantSubscription
{
    use TechnicalProperties;
    use Label;

    #[ORM\OneToOne(inversedBy: 'applicantSubscription', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Applicant $applicant = null;

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }
}
