<?php

namespace App\Entity\Company\Group;

use App\Entity\JobType;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

trait CompanyGroupActivity
{
    /**
     * General description of CompanyGroup customers
     *
     * @ORM\Column(type="string")
     */
    private ?string $customerDesc = null;

    /**
     * Number of CompanyGroup customers
     *
     * @ORM\Column(type="integer")
     */
    private ?int $customersNumber = null;

    /**
     * CompanyGroup Jobs Types
     *
     * @var ArrayCollection<JobType>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\JobType")
     * @ORM\JoinTable(name="company_group_job_types",
     *      joinColumns={@JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="job_type_slug", referencedColumnName="slug")}
     * )
     */
    private iterable $jobTypes;

    /**
     * CompanyGroup Badges
     *
     * @var ArrayCollection<CompanyBadge>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Company\Group\CompanyBadge")
     * @ORM\JoinTable(name="company_group_job_types",
     *      joinColumns={@JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="job_type_slug", referencedColumnName="slug")}
     * )
     */
    private iterable $badges;

    /**
     * Tools used in the CompanyGroup
     *
     * @var ArrayCollection<CompanyTool>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Company\CompanyTool")
     * @ORM\JoinTable(name="company_group_tools",
     *      joinColumns={@JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tool_id", referencedColumnName="id")}
     * )
     */
    private iterable $tools;

    /**
     * Get general description of CompanyGroup Customers
     */
    public function getCustomerDesc(): ?string
    {
        return $this->customerDesc;
    }

    /**
     * Set general description of CompanyGroup customers
     */
    public function setCustomerDesc(?string $customerDesc): self
    {
        $this->customerDesc = $customerDesc;

        return $this;
    }

    /**
     * Check if the CompanyGroup has Customers description
     */
    public function hasCustomerDesc(): ?string
    {
        $customerDesc = trim($this->getCustomerDesc());

        return (is_string($customerDesc) && strlen($customerDesc) > 0);
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
            && Utils::checkArrayValuesObject($tools, CompanyTool::class);
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

        if (CompanyBadge::areBadges($badges) || $badges->isEmpty()) {
            $this->badges = $badges;
        }

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
