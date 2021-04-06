<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\CompanyEntity\CompanyEntityOffices;
use App\Entity\Company\CompanyEntity\CompanyEntityTeam;
use App\Entity\Offer;
use App\Repository\CompanyEntityRepository;
use App\Trait\UseSlug;
use App\Trait\UseUuid;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company Entity
 *
 * @ORM\Entity
 */
#[ApiResource]
class CompanyEntity extends CompanyEntityRepository
{
    use UseUuid;
    use UseSlug;
    use CompanyEntityOffices;
    use CompanyEntityTeam;

    /**
     * CompanyEntity Group
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\CompanyGroup", inversedBy="entities")
     */
    private CompanyGroup $companyGroup;

    /**
     * CompanyEntity Offers
     *
     * @var ArrayCollection<Offer>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Offer", mappedBy="companyEntity", cascade={"persist"})
     */
    private iterable $offers;

    /**
     * CompanyEntity Contructor
     */
    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->teamMedias = new ArrayCollection();
        $this->officesMedias = new ArrayCollection();
    }

    /**
     * Get CompanyEntity Offers
     */
    public function getOffers(): ArrayCollection
    {
        return $this->offers;
    }

    /**
     * Set CompanyEntity Offers
     */
    public function setOffers(ArrayCollection|array|null $offers): self
    {
        $offers = Utils::createArrayCollection($offers);

        $this->offers = $offers;

        return $this;
    }

    /**
     * Add an Offer to the CompanyEntity
     */
    public function addOffer(Offer $offer): self
    {
        $this->offers->add($offer);

        return $this;
    }

    /**
     * Remove an Offer to the CompanyEntity
     */
    public function removeOffer(Offer $offer): self
    {
        $this->offers->remove($offer);

        return $this;
    }

    /**
     * Check if CompanyEntity has offers
     */
    public function hasOffers(): bool
    {
        $offers = $this->getOffers();

        return $offers instanceof ArrayCollection && !$offers->isEmpty();
    }
}
