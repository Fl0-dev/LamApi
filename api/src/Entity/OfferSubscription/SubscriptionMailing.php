<?php

namespace App\Entity\OfferSubscription;

use App\Entity\Offer\Offer;
use App\Repository\SubscriptionMailingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionMailingRepository::class)]
class SubscriptionMailing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $sendingType = null;

    #[ORM\ManyToOne(inversedBy: 'subscriptionMailings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OfferResearchSubscription $offerResearchSubscription = null;

    #[ORM\ManyToMany(targetEntity: Offer::class)]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSendingType(): ?string
    {
        return $this->sendingType;
    }

    public function setSendingType(string $sendingType): self
    {
        $this->sendingType = $sendingType;

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

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        $this->offers->removeElement($offer);

        return $this;
    }
}
