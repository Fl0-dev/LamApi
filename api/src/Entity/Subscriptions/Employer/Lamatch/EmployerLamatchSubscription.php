<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerLamatchSubscriptionRepository::class)]
#[ApiResource]
class EmployerLamatchSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'employerLamatchSubscription', targetEntity: EmployerLamatchProfile::class)]
    private Collection $employerLamatchProfiles;

    public function __construct()
    {
        $this->employerLamatchProfiles = new ArrayCollection();
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, EmployerLamatchProfile>
     */
    public function getEmployerLamatchProfiles(): Collection
    {
        return $this->employerLamatchProfiles;
    }

    public function addEmployerLamatchProfile(EmployerLamatchProfile $employerLamatchProfile): self
    {
        if (!$this->employerLamatchProfiles->contains($employerLamatchProfile)) {
            $this->employerLamatchProfiles->add($employerLamatchProfile);
            $employerLamatchProfile->setEmployerLamatchSubscription($this);
        }

        return $this;
    }

    public function removeEmployerLamatchProfile(EmployerLamatchProfile $employerLamatchProfile): self
    {
        if ($this->employerLamatchProfiles->removeElement($employerLamatchProfile)) {
            // set the owning side to null (unless already changed)
            if ($employerLamatchProfile->getEmployerLamatchSubscription() === $this) {
                $employerLamatchProfile->setEmployerLamatchSubscription(null);
            }
        }

        return $this;
    }
}
