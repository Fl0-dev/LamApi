<?php

namespace App\Entity\Revision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Offer\Offer;
use App\Repository\RevisionRepositories\OfferRevisionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRevisionRepository::class)]
#[ApiResource]
class OfferRevision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'offerRevisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $offer = null;

    public function getId(): ?int
    {
        return $this->id;
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
}
