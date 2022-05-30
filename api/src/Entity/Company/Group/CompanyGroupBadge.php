<?php

namespace App\Entity\Company\Group;

use App\Entity\Badge;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyEntity Badge
 *
 */
#[ORM\Entity(repositoryClass: CompanyGroupBadgeRepository::class)]
#[ORM\Table(name: "company_group_has_badge")]
class CompanyGroupBadge
{
    use Uuid;

    /**
     * CompanyGroup
     *
     */
    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: "badges")]
    private ?CompanyGroup $companyGroup = null;

    #[ORM\ManyToOne(targetEntity: Badge::class, inversedBy: "companyGroups")]
    private ?Badge $badge = null;

    /**
     * Description of Badge for this CompanyGroup (why they are this badge)
     *
     */
    #[ORM\Column(type: "string")]
    private ?string $description = null;

    /**
     * Constructor
     */
    public function __construct(?CompanyGroup $companyGroup = null, ?Badge $badge = null)
    {
        $this->setCompanyGroup($companyGroup);
        $this->setBadge($badge);
    }

    /**
     * Get the CompanyGroup attached to
     */
    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    /**
     * Set the CompanyGroup attached to
     */
    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }

    /**
     * Check if has a valid CompanyGroup attached to
     */
    public function hasCompanyGroup(): bool
    {
        return $this->companyGroup instanceof CompanyGroup;
    }

    /**
     * Get the Badge
     */
    public function getBadge(): ?Badge
    {
        return $this->badge;
    }

    /**
     * Set the Badge
     */
    public function setBadge(?Badge $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Check if has a valid Badge
     */
    public function hasBadge(): bool
    {
        $badge = $this->getBadge();

        return $badge instanceof Badge && $badge->hasSlug();
    }

    /**
     * Get Description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Description
     */
    public function setDescription(?string $description): self
    {
        $this->description = trim($description);

        return $this;
    }

    /**
     * Check if has a valid Description
     */
    public function hasDescription(): bool
    {
        $description = $this->getDescription();

        return is_string($description) && strlen($description) > 0;
    }
}
