<?php

namespace App\Entity\OfferSubscription;

use App\Entity\Applicant\Applicant;
use App\Entity\JobTitle;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferResearchRepository::class)]
class OfferResearch
{
    use Uuid;
    use CreatedDate;

    #[ORM\ManyToMany(targetEntity: City::class)]
    private Collection $cities;

    #[ORM\ManyToMany(targetEntity: Department::class)]
    private Collection $departments;

    #[ORM\ManyToMany(targetEntity: JobTitle::class)]
    private Collection $jobTitles;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $experiences = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $contractTypes = [];

    #[ORM\Column]
    private ?int $nbResult = null;

    #[ORM\ManyToOne]
    private ?Applicant $applicant = null;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->departments = new ArrayCollection();
        $this->jobTitles = new ArrayCollection();
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
     * @return Collection<int, JobTitle>
     */
    public function getJobTitles(): Collection
    {
        return $this->jobTitles;
    }

    public function addJobTitle(JobTitle $jobTitle): self
    {
        if (!$this->jobTitles->contains($jobTitle)) {
            $this->jobTitles->add($jobTitle);
        }

        return $this;
    }

    public function removeJobTitle(JobTitle $jobTitle): self
    {
        $this->jobTitles->removeElement($jobTitle);

        return $this;
    }

    public function getExperiences(): array
    {
        return $this->experiences;
    }

    public function setExperiences(?array $experiences): self
    {
        $this->experiences = $experiences;

        return $this;
    }

    public function getContractTypes(): array
    {
        return $this->contractTypes;
    }

    public function setContractTypes(?array $contractTypes): self
    {
        $this->contractTypes = $contractTypes;

        return $this;
    }

    public function getNbResult(): ?int
    {
        return $this->nbResult;
    }

    public function setNbResult(int $nbResult): self
    {
        $this->nbResult = $nbResult;

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
}
