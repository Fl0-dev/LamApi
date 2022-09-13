<?php

namespace App\Entity\Research;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Entity\Badge;
use App\Entity\Company\CompanyGroup;
use App\Entity\JobType;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Tool;
use App\Repository\ResearchRepositories\CompanyResearchRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyResearchRepository::class)]
#[ApiResource]
class CompanyResearch
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CompanyName = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $workforces;

    #[ORM\ManyToMany(targetEntity: City::class)]
    private Collection $cities;

    #[ORM\ManyToMany(targetEntity: Department::class)]
    private Collection $departments;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    private Collection $jobTypes;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    private Collection $tools;

    #[ORM\ManyToMany(targetEntity: Badge::class)]
    private Collection $badges;

    #[ORM\Column(nullable: true)]
    private ?int $nbResults = null;

    #[ORM\ManyToOne]
    private ?Applicant $applicant = null;

    #[ORM\ManyToMany(targetEntity: CompanyGroup::class)]
    private Collection $companyResults;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->departments = new ArrayCollection();
        $this->jobTypes = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->companyResults = new ArrayCollection();
    }

    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    public function setCompanyName(?string $CompanyName): self
    {
        $this->CompanyName = $CompanyName;

        return $this;
    }

    public function getWorkforces(): array
    {
        return $this->workforces;
    }

    public function addWorkforce(?string $workforce): self
    {
        if ($this->workforces === null) {
            $this->workforces = [];
        }
        if (!in_array($workforce, $this->workforces)) {
            $this->workforces[] = $workforce;
        }

        return $this;
    }

    public function removeWorkforce(?string $workforce): self
    {
        if (in_array($workforce, $this->workforces)) {
            unset($workforce, $this->workforces);
        } 

        return $this;
    }

    /**
     * @return Collection<int, City>
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities->add($city);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        $this->cities->removeElement($city);

        return $this;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->departments->contains($department)) {
            $this->departments->add($department);
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        $this->departments->removeElement($department);

        return $this;
    }

    /**
     * @return Collection<int, JobType>
     */
    public function getJobTypes(): Collection
    {
        return $this->jobTypes;
    }

    public function addJobType(JobType $jobType): self
    {
        if (!$this->jobTypes->contains($jobType)) {
            $this->jobTypes->add($jobType);
        }

        return $this;
    }

    public function removeJobType(JobType $jobType): self
    {
        $this->jobTypes->removeElement($jobType);

        return $this;
    }

    /**
     * @return Collection<int, Tool>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools->add($tool);
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        $this->tools->removeElement($tool);

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges->add($badge);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        $this->badges->removeElement($badge);

        return $this;
    }

    public function getNbResults(): ?int
    {
        return $this->nbResults;
    }

    public function setNbResults(?int $nbResults): self
    {
        $this->nbResults = $nbResults;

        return $this;
    }

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(?Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }

    /**
     * @return Collection<int, CompanyGroup>
     */
    public function getCompanyResults(): Collection
    {
        return $this->companyResults;
    }

    public function addCompanyResult(CompanyGroup $companyResult): self
    {
        if (!$this->companyResults->contains($companyResult)) {
            $this->companyResults->add($companyResult);
        }

        return $this;
    }

    public function removeCompanyResult(CompanyGroup $companyResult): self
    {
        $this->companyResults->removeElement($companyResult);

        return $this;
    }
}
