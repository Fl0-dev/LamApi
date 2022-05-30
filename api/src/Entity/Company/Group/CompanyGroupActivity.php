<?php

namespace App\Entity\Company\Group;

use App\Entity\Badge;
use App\Entity\Tool;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

trait CompanyGroupActivity
{
    /**
     * General description of CompanyGroup customers
     */
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $customersDesc = null;

    /**
     * Number of CompanyGroup customers
     */
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $customersNumber = null;

    #[ORM\OneToMany(targetEntity: CompanyGroupBadge::class, mappedBy: "companyGroup")]
    private $badges;

    #[ORM\OneToMany(targetEntity: CompanyGroupJobType::class, mappedBy: "companyGroup")]
    private $jobTypes;

    #[ORM\OneToMany(targetEntity: CompanyGroupTool::class, mappedBy: "companyGroup")]
    private $tools;

    /**
     * Get general description of CompanyGroup Customers
     */
    public function getCustomersDesc(): ?string
    {
        return $this->customersDesc;
    }

    /**
     * Set general description of CompanyGroup customers
     */
    public function setCustomersDesc(?string $customersDesc): self
    {
        $this->customersDesc = $customersDesc;

        return $this;
    }

    /**
     * Check if the CompanyGroup has Customers description
     */
    public function hasCustomersDesc(): ?string
    {
        $customersDesc = trim($this->getCustomersDesc());

        return (is_string($customersDesc) && strlen($customersDesc) > 0);
    }

    /**
     * Get number of CompanyGroup customers
     */
    public function getCustomersNumber(): ?int
    {
        return $this->customersNumber;
    }

    /**
     * Set number of CompanyGroup Customers
     */
    public function setCustomersNumber(?int $customersNumber): self
    {
        $this->customersNumber = $customersNumber;

        return $this;
    }

    /**
     * Check if the CompanyGroup has Customers number
     */
    public function hasCustomersNumber(): bool
    {
        $customersNumber = $this->getCustomersNumber();

        return is_int($customersNumber) && $customersNumber > 0;
    }

    /**
     * Get list of Tools
     */
    public function getTools(): ArrayCollection
    {
        return $this->tools;
    }

    /**
     * Set list of Tools
     */
    public function setTools(ArrayCollection|array|null $tools): self
    {
        $tools = Utils::createArrayCollection($tools);

        $this->tools = $tools;

        return $this;
    }

    /**
     * Check if the CompanyGroup has Tools
     */
    public function hasTools(): bool
    {
        $tools = $this->getTools();

        return $tools instanceof ArrayCollection
            && !$tools->isEmpty()
            && Utils::checkArrayValuesObject($tools, Tool::class);
    }

    /**
     * Get list of Job Types
     */
    public function getJobTypes(): ArrayCollection
    {
        return $this->jobTypes;
    }

    /**
     * Set list of Job Types
     */
    public function setJobTypes(ArrayCollection|array|null $jobTypes): self
    {
        $jobTypes = Utils::createArrayCollection($jobTypes);

        $this->jobTypes = $jobTypes;

        return $this;
    }

    /**
     * Add a JobType
     */
    public function addJobType(CompanyGroupJobType $jobType): self
    {
        $this->entities->add($jobType);

        return $this;
    }

    /**
     * Remove a JobType
     */
    public function removeJobType(CompanyGroupJobType $jobType): self
    {
        $this->entities->remove($jobType);

        return $this;
    }

    /**
     * Check if the CompanyGroup has Job Types
     */
    public function hasJobTypes(): bool
    {
        $jobTypes = $this->getJobTypes();

        return $jobTypes instanceof ArrayCollection && !$jobTypes->isEmpty();
    }

    /**
     * Get list of Badge
     */
    public function getBadges(): ArrayCollection
    {
        return $this->badges;
    }

    /**
     * Set list of Badge
     */
    public function setBadges(ArrayCollection|array|null $badges): self
    {
        $badges = Utils::createArrayCollection($badges);

        if (Badge::areBadges($badges) || $badges->isEmpty()) {
            $this->badges = $badges;
        }

        return $this;
    }

    /**
     * Add a Badge
     */
    public function addBadge(CompanyGroupBadge $badge): self
    {
        $this->entities->add($badge);

        return $this;
    }

    /**
     * Remove a Badge
     */
    public function removeBadge(CompanyGroupBadge $badge): self
    {
        $this->entities->remove($badge);

        return $this;
    }

    /**
     * Check if CompanyGroup has Badges
     */
    public function hasBadges(): bool
    {
        $badges = $this->getBadges();

        return $badges instanceof ArrayCollection && !$badges->isEmpty();
    }
}
