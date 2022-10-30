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
#[ApiResource]
class ApplicantLamatch
{
    use Uuid;
    use CreatedDate;
    
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantLamatchSubscription $lamatchSubscription = null;

    #[ORM\OneToMany(mappedBy: 'applicantLamatch', targetEntity: CompanyGroupResult::class)]
    private Collection $companyGroupResults;

    public function __construct()
    {
        $this->companyGroupResults = new ArrayCollection();
    }

    public function getLamatchSubscription(): ?ApplicantLamatchSubscription
    {
        return $this->lamatchSubscription;
    }

    public function setLamatchSubscription(ApplicantLamatchSubscription $lamatchSubscription): self
    {
        $this->lamatchSubscription = $lamatchSubscription;

        return $this;
    }

    /**
     * @return Collection<int, CompanyGroupResult>
     */
    public function getCompanyGroupResults(): Collection
    {
        return $this->companyGroupResults;
    }

    public function addCompanyGroupResult(CompanyGroupResult $companyGroupResult): self
    {
        if (!$this->companyGroupResults->contains($companyGroupResult)) {
            $this->companyGroupResults->add($companyGroupResult);
            $companyGroupResult->setApplicantLamatch($this);
        }

        return $this;
    }

    public function removeCompanyGroupResult(CompanyGroupResult $companyGroupResult): self
    {
        if ($this->companyGroupResults->removeElement($companyGroupResult)) {
            // set the owning side to null (unless already changed)
            if ($companyGroupResult->getApplicantLamatch() === $this) {
                $companyGroupResult->setApplicantLamatch(null);
            }
        }

        return $this;
    }
}
