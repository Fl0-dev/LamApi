<?php

namespace App\Entity\Subscriptions\Applicant\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantLamatchRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantLamatchRepository::class)]
#[ApiResource()]
class ApplicantLamatch
{
    use Uuid;
    use CreatedDate;

    #[ORM\OneToMany(mappedBy: 'applicantLamatch', targetEntity: CompanyEntityResult::class)]
    private Collection $companyEntityResults;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantLamatchSubscription $lamatchSubscription = null;

    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->companyEntityResults = new ArrayCollection();
    }

    /**
     * @return Collection<int, CompanyEntityResult>
     */
    public function getCompanyEntityResults(): Collection
    {
        return $this->companyEntityResults;
    }

    public function addCompanyEntityResult(CompanyEntityResult $companyEntityResult): self
    {
        if (!$this->companyEntityResults->contains($companyEntityResult)) {
            $this->companyEntityResults->add($companyEntityResult);
            $companyEntityResult->setApplicantLamatch($this);
        }

        return $this;
    }

    public function removeCompanyEntityResult(CompanyEntityResult $companyEntityResult): self
    {
        if ($this->companyEntityResults->removeElement($companyEntityResult)) {
            // set the owning side to null (unless already changed)
            if ($companyEntityResult->getApplicantLamatch() === $this) {
                $companyEntityResult->setApplicantLamatch(null);
            }
        }

        return $this;
    }

    public function getLamatchSubscription(): ?ApplicantLamatchSubscription
    {
        return $this->lamatchSubscription;
    }

    public function setLamatchSubscription(?ApplicantLamatchSubscription $lamatchSubscription): self
    {
        $this->lamatchSubscription = $lamatchSubscription;

        return $this;
    }
}
