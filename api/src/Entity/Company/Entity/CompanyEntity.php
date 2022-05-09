<?php

namespace App\Entity\Company\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\Entity\CompanyEntityOffices;
use App\Entity\Company\Group\CompanyGroup;
use App\Entity\Offer\Offer;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company Entity
 *
 * @ORM\Entity
 */
#[ApiResource(
    routePrefix: '/company'
)]
class CompanyEntity
{
    use Uuid;
    use Slug;
    use CompanyEntityOffices;

    /**
     * CompanyEntity Group
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\Group\CompanyGroup", inversedBy="entities")
     */
    private CompanyGroup $companyGroup;

    /**
     * CompanyEntity Offers
     *
     * @var ArrayCollection<Offer>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Offer\Offer", mappedBy="companyEntity", cascade={"persist"})
     */
    private iterable $offers;

    /**
     * CompanyEntity Contructor
     */
    public function __construct(CompanyGroup $companyGroup)
    {
        $this->companyGroup = $companyGroup;
        $this->offers = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->teamMedias = new ArrayCollection();
        $this->officesMedias = new ArrayCollection();
    }

    /**
     * Get the CompanyGroup
     */
    public function getCompanyGroup(): CompanyGroup
    {
        return $this->companyGroup;
    }

    /**
     * Set the CompanyGroup
     */
    public function setCompanyGroup(CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
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
