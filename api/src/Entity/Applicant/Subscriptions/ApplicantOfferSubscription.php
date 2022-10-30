<?php

namespace App\Entity\Applicant\Subscriptions;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Research\OfferResearch;
use App\Repository\Applicant\Subscriptions\ApplicantOfferSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantOfferSubscriptionRepository::class)]
#[ApiResource]
class ApplicantOfferSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?OfferResearch $offerResearch = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOfferResearch(): ?OfferResearch
    {
        return $this->offerResearch;
    }

    public function setOfferResearch(OfferResearch $offerResearch): self
    {
        $this->offerResearch = $offerResearch;

        return $this;
    }
}
