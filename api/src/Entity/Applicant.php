<?php

namespace App\Entity;

use App\Repository\ApplicantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
#[ORM\Table(name: "Applicants")]
class Applicant extends UserConsumer
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
}