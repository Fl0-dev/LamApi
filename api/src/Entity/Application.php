<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApplicationRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
#[ApiResource()]
class Application
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $motivation;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $score;

    #[ORM\ManyToOne(targetEntity: Applicant::class, inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $applicant;

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'applications')]
    #[Groups(['read:getCompanyGroupApplications'])]
    private $offer;

    #[ORM\ManyToOne(targetEntity: ApplicantCv::class)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $cv;

    #[ORM\ManyToOne(targetEntity: CompanyEntity::class, inversedBy: 'applications')]
    private $companyEntity;

    #[ORM\OneToMany(mappedBy: 'application', targetEntity: ApplicantionExchange::class)]
    private $applicantionExchanges;

    #[ORM\Column(length: 11)]
    private ?string $status = null;

    public function __construct()
    {
        $this->applicantionExchanges = new ArrayCollection();
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

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

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getCv(): ?ApplicantCv
    {
        return $this->cv;
    }

    public function setCv(?ApplicantCv $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

        return $this;
    }

    /**
     * @return Collection<int, ApplicantionExchange>
     */
    public function getApplicantionExchanges(): Collection
    {
        return $this->applicantionExchanges;
    }

    public function addApplicantionExchange(ApplicantionExchange $applicantionExchange): self
    {
        if (!$this->applicantionExchanges->contains($applicantionExchange)) {
            $this->applicantionExchanges[] = $applicantionExchange;
            $applicantionExchange->setApplication($this);
        }

        return $this;
    }

    public function removeApplicantionExchange(ApplicantionExchange $applicantionExchange): self
    {
        if ($this->applicantionExchanges->removeElement($applicantionExchange)) {
            // set the owning side to null (unless already changed)
            if ($applicantionExchange->getApplication() === $this) {
                $applicantionExchange->setApplication(null);
            }
        }

        return $this;
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
}
