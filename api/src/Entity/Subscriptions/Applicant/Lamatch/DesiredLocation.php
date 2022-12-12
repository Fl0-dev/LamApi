<?php

namespace App\Entity\Subscriptions\Applicant\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Repository\SubscriptionRepositories\Applicant\DesiredLocationRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DesiredLocationRepository::class)]
#[ApiResource]
class DesiredLocation
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\ManyToMany(targetEntity: City::class)]
    #[Groups([ApplicantLamatchProfile::OPERATION_NAME_GET_APPLICANT_LAMATCH_PROFILE_BY_CURRENT_APPLICANT,])]
    private Collection $desiredCities;

    #[ORM\ManyToMany(targetEntity: Department::class)]
    #[Groups([ApplicantLamatchProfile::OPERATION_NAME_GET_APPLICANT_LAMATCH_PROFILE_BY_CURRENT_APPLICANT,])]
    private Collection $desiredDepartments;

    public function __construct()
    {
        $this->desiredCities = new ArrayCollection();
        $this->desiredDepartments = new ArrayCollection();
        $this->setCreatedDate(new \DateTime());
        $this->setLastModifiedDate(new \DateTime());
    }

    /**
     * @return Collection<int, City>
     */
    public function getDesiredCities(): Collection
    {
        return $this->desiredCities;
    }

    public function addDesiredCity(City $desiredCity): self
    {
        if (!$this->desiredCities->contains($desiredCity)) {
            $this->desiredCities->add($desiredCity);
        }

        return $this;
    }

    public function removeDesiredCity(City $desiredCity): self
    {
        $this->desiredCities->removeElement($desiredCity);

        return $this;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDesiredDepartments(): Collection
    {
        return $this->desiredDepartments;
    }

    public function addDesiredDepartment(Department $desiredDepartment): self
    {
        if (!$this->desiredDepartments->contains($desiredDepartment)) {
            $this->desiredDepartments->add($desiredDepartment);
        }

        return $this;
    }

    public function removeDesiredDepartment(Department $desiredDepartment): self
    {
        $this->desiredDepartments->removeElement($desiredDepartment);

        return $this;
    }
}
