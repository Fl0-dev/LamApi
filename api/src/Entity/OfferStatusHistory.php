<?php

namespace App\Entity;

use App\Repository\OfferStatusHistoryRepository;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferStatusHistoryRepository::class)]
class OfferStatusHistory
{
    use Uuid;
    use LastModifiedDate;

    #[ORM\Column(type: 'string', length: 9)]
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
