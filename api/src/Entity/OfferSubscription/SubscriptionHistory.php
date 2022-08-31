<?php

namespace App\Entity\OfferSubscription;

use App\Repository\SubscriptionHistoryRepository;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionHistoryRepository::class)]
class SubscriptionHistory
{
    use Uuid;
    use LastModifiedDate;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $unsubscribeReasons = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?OfferResearchSubscription $offerResearchSubscription = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?OfferResearch $offerResearch = null;

    public function getUnsubscribeReasons(): ?string
    {
        return $this->unsubscribeReasons;
    }

    public function setUnsubscribeReasons(?string $unsubscribeReasons): self
    {
        $this->unsubscribeReasons = $unsubscribeReasons;

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

    public function getOfferResearchSubscription(): ?OfferResearchSubscription
    {
        return $this->offerResearchSubscription;
    }

    public function setOfferResearchSubscription(?OfferResearchSubscription $offerResearchSubscription): self
    {
        $this->offerResearchSubscription = $offerResearchSubscription;

        return $this;
    }

    public function getOfferResearch(): ?OfferResearch
    {
        return $this->offerResearch;
    }

    public function setOfferResearch(?OfferResearch $offerResearch): self
    {
        $this->offerResearch = $offerResearch;

        return $this;
    }
}
