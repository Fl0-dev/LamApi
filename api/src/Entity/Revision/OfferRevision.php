<?php

namespace App\Entity\Revision;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Offer\Offer;
use App\Repository\RevisionRepositories\OfferRevisionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\FieldContent;
use App\Transversal\FieldName;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: OfferRevisionRepository::class)]
class OfferRevision
{
    use Uuid;
    use CreatedDate;
    use FieldName;
    use FieldContent;

    #[ORM\ManyToOne(inversedBy: 'offerRevisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $offer = null;

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
