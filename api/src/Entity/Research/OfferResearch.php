<?php

namespace App\Entity\Research;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Entity\JobTitle;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Offer\Offer;
use App\Repository\ResearchRepositories\OfferResearchRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
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

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private $experiences;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private $contractTypes;

    #[ORM\ManyToOne]
    private ?Applicant $applicant = null;

    #[ORM\ManyToMany(targetEntity: Offer::class)]
    private Collection $offerResults;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->departments = new ArrayCollection();
        $this->jobTitles = new ArrayCollection();
        $this->offerResults = new ArrayCollection();
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

    public function addExperience(?string $experience): self
    {
        if (!is_array($this->experiences)) {
            $this->experiences = [];
        }

        if (!in_array($experience, $this->experiences)) {
            $this->experiences[] = $experience;
        }

        return $this;
    }

    public function removeExperience(?string $experience): self
    {
        if (in_array($experience, $this->experiences)) {
            unset($experience, $this->experiences);
        } 

        return $this;
    }

    public function getContractTypes(): array
    {
        return $this->contractTypes;
    }

    public function addContractType(?string $contractType): self
    {
        if (!is_array($this->contractTypes)) {
            $this->contractTypes = [];
        }

        if (!in_array($contractType, $this->contractTypes)) {
            $this->contractTypes[] = $contractType;
        }

        return $this;
    }

    public function removeContractType(?string $contractType): self
    {
        if (in_array($contractType, $this->contractTypes)) {
            unset($contractType, $this->contractTypes);
        } 

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
     * @return Collection<int, Offer>
     */
    public function getOfferResults(): Collection
    {
        return $this->offerResults;
    }

    public function addOfferResult(Offer $offerResult): self
    {
        if (!$this->offerResults->contains($offerResult)) {
            $this->offerResults->add($offerResult);
        }

        return $this;
    }

    public function removeOfferResult(Offer $offerResult): self
    {
        $this->offerResults->removeElement($offerResult);

        return $this;
    }
}
