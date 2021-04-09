<?php

namespace App\Entity\Company\Group;

use App\Entity\Organisation;
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
     * @ORM\Column(type="string")
     */
    private ?string $website = null;

    /**
     * CompanyGroup Social Networks
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Social")
     */
    private ?Social $social = null;

    /**
     * CompanyGroup Ecosystem
     *
     * @var ArrayCollection<Organisation>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Organisation")
     * @ORM\JoinTable(name="company_group_ecosystem",
     *      joinColumns={@JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="organisation_id", referencedColumnName="id")}
     * )
     */
    private iterable $ecosystem;

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
     * Get CompanyGroup Ecosystem
     */
    public function getEcosystem(): ArrayCollection
    {
        return $this->ecosystem;
    }

    /**
     * Set CompanyGroup Ecosystem
     */
    public function setEcosystem(ArrayCollection|array|null $ecosystem)
    {
        $ecosystem = Utils::createArrayCollection($ecosystem);

        $this->ecosystem = $ecosystem;

        return $this;
    }

    /**
     * Check if the CompanyGroup has a valid Ecosystem
     */
    public function hasEcosystem(): bool
    {
        $ecosystem = $this->getEcosystem();

        return ($ecosystem instanceof ArrayCollection && !$ecosystem->isEmpty());
    }
}
