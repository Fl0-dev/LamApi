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

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApplicantCompanySubscription $companySubscription = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApplicantOfferSubscription $offerSubscription = null;

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }

    public function getCompanySubscription(): ?ApplicantCompanySubscription
    {
        return $this->companySubscription;
    }

    public function setCompanySubscription(?ApplicantCompanySubscription $companySubscription): self
    {
        $this->companySubscription = $companySubscription;

        return $this;
    }

    public function getOfferSubscription(): ?ApplicantOfferSubscription
    {
        return $this->offerSubscription;
    }

    public function setOfferSubscription(?ApplicantOfferSubscription $offerSubscription): self
    {
        $this->offerSubscription = $offerSubscription;

        return $this;
    }
}
