<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApplicantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
#[ORM\Table(name: "Applicants")]
#[ApiResource()]
class Applicant extends UserPhysical
{
    #[ORM\Column(type: 'text', nullable: true)]
    private $messagePerso;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $linkedin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $providedFrom;

    #[ORM\OneToMany(mappedBy: 'applicant', targetEntity: ApplicantCv::class)]
    private $applicantCvs;

    #[ORM\OneToMany(mappedBy: 'applicant', targetEntity: Application::class)]
    private $applications;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    private $levelOfStudy;

    #[ORM\ManyToOne(targetEntity: JobTitle::class)]
    private $jobTitle;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $experience;

    #[ORM\ManyToOne(targetEntity: City::class)]
    private $city;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $contractType;

    #[ORM\Column(type: 'string', length: 11)]
    private $status;

    /**
     * Indicates if the user wanted explicitly create its account (true)
     * or if it's Lamacompta without consentment (false)
     *
     */
    #[ORM\Column(type: "boolean", nullable: true)]
    private $optin;

    public function __construct()
    {
        parent::__construct();
        $this->applicantCvs = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    public function getMessagePerso(): ?string
    {
        return $this->messagePerso;
    }

    public function setMessagePerso(?string $messagePerso): self
    {
        $this->messagePerso = $messagePerso;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getProvidedFrom(): ?string
    {
        return $this->providedFrom;
    }

    public function setProvidedFrom(?string $providedFrom): self
    {
        $this->providedFrom = $providedFrom;

        return $this;
    }

    /**
     * @return Collection<int, ApplicantCv>
     */
    public function getApplicantCvs(): Collection
    {
        return $this->applicantCvs;
    }

    public function addApplicantCv(ApplicantCv $applicantCv): self
    {
        if (!$this->applicantCvs->contains($applicantCv)) {
            $this->applicantCvs[] = $applicantCv;
            $applicantCv->setApplicant($this);
        }

        return $this;
    }

    public function removeApplicantCv(ApplicantCv $applicantCv): self
    {
        if ($this->applicantCvs->removeElement($applicantCv)) {
            // set the owning side to null (unless already changed)
            if ($applicantCv->getApplicant() === $this) {
                $applicantCv->setApplicant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setApplicant($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getApplicant() === $this) {
                $application->setApplicant(null);
            }
        }

        return $this;
    }

    public function getLevelOfStudy(): ?string
    {
        return $this->levelOfStudy;
    }

    public function setLevelOfStudy(?string $levelOfStudy): self
    {
        $this->levelOfStudy = $levelOfStudy;

        return $this;
    }

    public function getJobTitle(): ?JobTitle
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?JobTitle $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contractType;
    }

    public function setContractType(?string $contractType): self
    {
        $this->contractType = $contractType;

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

    public function getOptin(): ?bool
    {
        return $this->optin;
    }

    public function setOptin(?bool $optin): self
    {
        $this->optin = $optin;

        return $this;
    }
}