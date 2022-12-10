<?php

namespace App\Entity\Subscriptions\Applicant;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\References\SubscriptionStatus;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantCompanySubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantCompanySubscriptionRepository::class)]
#[ApiResource]
class ApplicantCompanySubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\OneToMany(
        mappedBy: 'applicantCompanySubscription',
        targetEntity: ApplicantCompany::class,
        cascade: ['persist', 'remove']
    )]
    private $applicantCompanies;

    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->lastModifiedDate = new \DateTime();
        $this->setStatus((new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId());
        $this->applicantCompanies = new ArrayCollection();
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
     * @return Collection|ApplicantCompany[]
     */
    public function getApplicantCompanies(): Collection
    {
        return $this->applicantCompanies;
    }

    public function addApplicantCompany(ApplicantCompany $applicantCompany): self
    {
        if (!$this->applicantCompanies->contains($applicantCompany)) {
            $this->applicantCompanies[] = $applicantCompany;
            $applicantCompany->setApplicantCompanySubscription($this);
        }

        return $this;
    }

    public function removeApplicantCompany(ApplicantCompany $applicantCompany): self
    {
        if ($this->applicantCompanies->removeElement($applicantCompany)) {
            // set the owning side to null (unless already changed)
            if ($applicantCompany->getApplicantCompanySubscription() === $this) {
                $applicantCompany->setApplicantCompanySubscription(null);
            }
        }

        return $this;
    }
}
