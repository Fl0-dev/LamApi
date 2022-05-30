<?php

namespace App\Entity\Company\Group;

use App\Entity\Tool;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyEntity Tool
 *
 */
#[ORM\Entity()]
#[ORM\Table(name: "company_group_has_tool")]
class CompanyGroupTool
{
    use Uuid;

    /**
     * CompanyGroup
     *
     */
    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: "tools")]
    private ?CompanyGroup $companyGroup = null;

    #[ORM\ManyToOne(targetEntity: Tool::class, inversedBy: "companyGroups")]
    private ?Tool $tool = null;

    /**
     * Constructor
     */
    public function __construct(?CompanyGroup $companyGroup = null, ?Tool $tool = null)
    {
        $this->setCompanyGroup($companyGroup);
        $this->setTool($tool);
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
     * Get the Tool
     */
    public function getTool(): ?Tool
    {
        return $this->tool;
    }

    /**
     * Set the Tool
     */
    public function setTool(?Tool $tool): self
    {
        $this->tool = $tool;

        return $this;
    }

    /**
     * Check if has a valid Tool
     */
    public function hasTool(): bool
    {
        $tool = $this->getTool();

        return $tool instanceof Tool && $tool->hasSlug();
    }
}
