<?php

namespace App\Entity\Company\Group;

use App\Entity\JobType;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company JobType
 *
 * @ORM\Entity
 */
class CompanyGroupJobType
{
    use Uuid;

    /**
     * CompanyGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\Group\CompanyGroup", inversedBy="jobTypes")
     */
    private ?CompanyGroup $companyGroup = null;

    #[ORM\ManyToOne(targetEntity: JobType::class)]
    private ?JobType $jobType = null;

    /**
     * CompanyJobType constructor
     */
    public function __construct(?CompanyGroup $companyGroup = null, ?JobType $jobType = null)
    {
        $this->setCompanyGroup($companyGroup);
        $this->setJobType($jobType);
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
     * Get the JobType
     */
    public function getJobType(): ?JobType
    {
        return $this->jobtype;
    }

    /**
     * Set the JobType
     */
    public function setJobType(?JobType $jobtype): self
    {
        $this->jobtype = $jobtype;

        return $this;
    }

    /**
     * Check if has a valid JobType
     */
    public function hasJobType(): bool
    {
        $jobtype = $this->getJobType();

        return $jobtype instanceof JobType && $jobtype->hasSlug();
    }
}
