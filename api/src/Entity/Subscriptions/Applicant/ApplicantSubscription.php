<?php

namespace App\Entity\Subscriptions\Applicant;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ApplicantSubscriptionRepository::class)]
#[ApiResource]
class ApplicantSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\OneToOne(inversedBy: 'applicantSubscription', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Applicant $applicant = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApplicantCompanySubscription $companySubscription = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApplicantOfferSubscription $offerSubscription = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApplicantLamatchSubscription $lamatchSubscription = null;

    public function __construct()
    {
        $this->setCreatedDate(new \DateTime());
        $this->setLastModifiedDate(new \DateTime());
    }

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

    public function getLamatchSubscription(): ?ApplicantLamatchSubscription
    {
        return $this->lamatchSubscription;
    }

    public function setLamatchSubscription(?ApplicantLamatchSubscription $lamatchSubscription): self
    {
        $this->lamatchSubscription = $lamatchSubscription;

        return $this;
    }
}
