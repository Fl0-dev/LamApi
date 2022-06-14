<?php

namespace App\Entity\Company\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\Entity\CompanyEntityOffices;
use App\Entity\Company\Group\CompanyGroup;
use App\Entity\Offer\Offer;
use App\Entity\User\Employer;
use App\Transversal\TechnicalProperties;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company Entity
 */
#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiResource(
    routePrefix: '/company'
)]
class CompanyEntity
{
    use TechnicalProperties;

    use CompanyEntityOffices;

    /**
     * CompanyEntity Group
     */
    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: "entities")]
    private CompanyGroup $companyGroup;

    /**
     * CompanyEntity Offers
     *
     * @var ArrayCollection<Offer>
     *
     */
    #[ORM\OneToMany(targetEntity: Offer::class, mappedBy: "companyEntity", cascade: ["persist"])]
    private iterable $offers;

    /**
     * CompanyEntity Administrators
     *
     * @var ArrayCollection<Employer>
     *
     */
    #[ORM\ManyToMany(targetEntity: Employer::class)]
    #[ORM\JoinTable(name: "entity_has_admin")]
    #[ORM\JoinColumn(name: "entity_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "admin_id", referencedColumnName: "id")]
    private iterable $employers;

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
        $this->employers = new ArrayCollection();
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

    /**
     * Get CompanyEntity employers
     */ 
    public function getEmployers(): ArrayCollection
    {
        return $this->employers;
    }

    /**
     * Set CompanyEntity employers
     *
     * @return  self
     */ 
    public function setEmployers(ArrayCollection|array|null $employers): self
    {
        $employers = Utils::createArrayCollection($employers);

        $this->employers = $employers;

        return $this;
    }
}
