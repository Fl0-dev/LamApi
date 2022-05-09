<?php

namespace App\Entity\Company\Group;

use App\Entity\Organisation;
use App\Entity\Pool;
use App\Entity\Social;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyGroup Communication
 */
trait CompanyGroupCommunication
{
    /**
     * CompanyGroup Website
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $website = null;

    /**
     * CompanyGroup Social Networks
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Social")
     */
    private ?Social $social = null;

    /**
     * CompanyGroup Pools
     *
     * @var ArrayCollection<Pool>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Pool")
     * @ORM\JoinTable(name="company_group_pools",
     *      joinColumns={@ORM\JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pool_id", referencedColumnName="id")}
     * )
     */
    private iterable $pools;

    /**
     * CompanyGroup Partners
     *
     * @var ArrayCollection<Organisation>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Organisation")
     * @ORM\JoinTable(name="company_group_partners",
     *      joinColumns={@ORM\JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="organisation_id", referencedColumnName="id")}
     * )
     */
    private iterable $partners;

    /**
     * Get CompanyGroup Website
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Set CompanyGroup Website
     */
    public function setWebsite(?string $website): self
    {
        if (!Utils::isUrl($website)) {
            $website = null;
        }

        $this->website = $website;

        return $this;
    }

    /**
     * Check if CompanyGroup has a valid Website
     */
    public function hasWebsite(): bool
    {
        return Utils::isUrl($this->getWebsite());
    }

    /**
     * Get CompanyGroup Social Networks
     */
    public function getSocial(): ?Social
    {
        return $this->social;
    }

    /**
     * Set CompanyGroup Social Networks
     */
    public function setSocial(?Social $social): self
    {
        $this->social = $social;

        return $this;
    }

    /**
     * Check if has valid Social
     */
    public function hasSocial(): bool
    {
        return $this->getSocial() instanceof Social;
    }

    /**
     * Get Pools
     */
    public function getPools(): ArrayCollection
    {
        return $this->pools;
    }

    /**
     * Set Pools
     */
    public function setPools(ArrayCollection|array|null $pools)
    {
        $pools = Utils::createArrayCollection($pools);

        $this->pools = $pools;

        return $this;
    }

    /**
     * Add a Pool
     */
    public function addPool(Pool $partner): self
    {
        $this->pools->add($partner);

        return $this;
    }

    /**
     * Remove a Pool
     */
    public function removePool(Pool $partner): self
    {
        $this->pools->remove($partner);

        return $this;
    }

    /**
     * Check if has valid Pools
     */
    public function hasPools(): bool
    {
        $pools = $this->getPools();

        return $pools instanceof ArrayCollection
            && !$pools->isEmpty()
            && Utils::checkArrayValuesObject($pools, Pool::class);
    }

    /**
     * Get Partners
     */
    public function getPartners(): ArrayCollection
    {
        return $this->partners;
    }

    /**
     * Set Partners
     */
    public function setPartners(ArrayCollection|array|null $partners)
    {
        $partners = Utils::createArrayCollection($partners);

        $this->partners = $partners;

        return $this;
    }

    /**
     * Add a Partner
     */
    public function addPartner(Organisation $partner): self
    {
        $this->partners->add($partner);

        return $this;
    }

    /**
     * Remove a Partner
     */
    public function removePartner(Organisation $partner): self
    {
        $this->partners->remove($partner);

        return $this;
    }

    /**
     * Check if has valid Partners
     */
    public function hasPartners(): bool
    {
        $partners = $this->getPartners();

        return $partners instanceof ArrayCollection
            && !$partners->isEmpty()
            && Utils::checkArrayValuesObject($partners, Organisation::class);
    }
}
