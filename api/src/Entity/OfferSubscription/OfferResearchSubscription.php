<?php

namespace App\Entity\OfferSubscription;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Repository\OfferSubscriptionRepositories\OfferResearchSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: OfferResearchSubscriptionRepository::class)]
class OfferResearchSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column]
    private ?bool $hasPublishedInfo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastSendingOffersDate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?OfferResearch $offerResearch = null;

    #[ORM\OneToOne(inversedBy: 'offerResearchSubscription', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Applicant $applicant = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'offerResearchSubscription', targetEntity: SubscriptionMailing::class)]
    private Collection $subscriptionMailings;

    public function __construct()
    {
        $this->subscriptionMailings = new ArrayCollection();
    }

    public function isHasPublishedInfo(): ?bool
    {
        return $this->hasPublishedInfo;
    }

    public function setHasPublishedInfo(bool $hasPublishedInfo): self
    {
        $this->hasPublishedInfo = $hasPublishedInfo;

        return $this;
    }

    public function getLastSendingOffersDate(): ?\DateTimeInterface
    {
        return $this->lastSendingOffersDate;
    }

    public function setLastSendingOffersDate(\DateTimeInterface $lastSendingOffersDate): self
    {
        $this->lastSendingOffersDate = $lastSendingOffersDate;

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

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(Applicant $applicant): self
    {
        $this->applicant = $applicant;

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

    /**
     * @return Collection<int, SubscriptionMailing>
     */
    public function getSubscriptionMailings(): Collection
    {
        return $this->subscriptionMailings;
    }

    public function addSubscriptionMailing(SubscriptionMailing $subscriptionMailing): self
    {
        if (!$this->subscriptionMailings->contains($subscriptionMailing)) {
            $this->subscriptionMailings->add($subscriptionMailing);
            $subscriptionMailing->setOfferResearchSubscription($this);
        }

        return $this;
    }

    public function removeSubscriptionMailing(SubscriptionMailing $subscriptionMailing): self
    {
        if ($this->subscriptionMailings->removeElement($subscriptionMailing)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionMailing->getOfferResearchSubscription() === $this) {
                $subscriptionMailing->setOfferResearchSubscription(null);
            }
        }

        return $this;
    }
}
