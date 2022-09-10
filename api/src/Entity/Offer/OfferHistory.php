<?php

namespace App\Entity\Offer;

use App\Entity\User\User;
use App\Repository\OfferRepositories\OfferHistoryRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferHistoryRepository::class)]
class OfferHistory
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(type: 'string')]
    private $offerStatus;

    #[ORM\ManyToOne(targetEntity: Offer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $offer;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private $updatedBy;

    public function getOfferStatus(): ?string
    {
        return $this->offerStatus;
    }

    public function setOfferStatus(string $offerStatus): self
    {
        $this->offerStatus = $offerStatus;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
