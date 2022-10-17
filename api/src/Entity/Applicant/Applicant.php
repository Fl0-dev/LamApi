<?php

namespace App\Entity\Applicant;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Application\Application;
use App\Entity\Location\City;
use App\Entity\JobTitle;
use App\Entity\References\ContractType;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Entity\User\UserPhysical;
use App\Repository\ApplicantRepositories\ApplicantRepository;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new GetCollection(
        uriTemplate: '/applicants',
        normalizationContext: [
            'groups' => [self::OPERATION_NAME_GET_ALL_APPLICANTS]
        ],
    ),
])]
#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
#[ORM\Table(name: "applicant")]
class Applicant extends UserPhysical
{
    public const OPERATION_NAME_GET_ALL_APPLICANTS = 'getApplicants';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $defaultMotivationText;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $linkedin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $providedFrom;

    #[ORM\OneToMany(mappedBy: 'applicant', targetEntity: ApplicantCv::class)]
    private $applicantCvs;

    #[ORM\OneToMany(mappedBy: 'applicant', targetEntity: Application::class)]
    private $applications;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $levelOfStudy;

    #[ORM\ManyToOne(targetEntity: JobTitle::class)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $jobTitle;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $experience;

    #[ORM\ManyToOne(targetEntity: City::class)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $city;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $contractType;

    #[ORM\Column(type: 'string')]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
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

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getContractType(): ?string
    {
        $contractTypeRepository = new ContractTypeRepository();
        $contractType = $contractTypeRepository->find($this->contractType);

        return $contractType instanceof ContractType ? $contractType->getLabel() : null;
    }

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getExperience(): ?string
    {
        $experienceRepository = new ExperienceRepository();
        $experience = $experienceRepository->find($this->experience);

        return $experience instanceof Experience ? $experience->getDuration() : null;
    }

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getLevelOfStudy(): ?string
    {
        $levelOfStudyRepository = new LevelOfStudyRepository();
        $levelOfStudy = $levelOfStudyRepository->find($this->levelOfStudy);

        return $levelOfStudy instanceof LevelOfStudy ? $levelOfStudy->getLabel() : null;
    }

    public function getPhysicalType(): string
    {
        return self::TYPE_APPLICANT;
    }

    public function getDefaultMotivationText(): ?string
    {
        return $this->defaultMotivationText;
    }

    public function setDefaultMotivationText(?string $defaultMotivationText): self
    {
        $this->defaultMotivationText = $defaultMotivationText;

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

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getLevelOfStudyId(): ?string
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

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getExperienceId(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
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

    public function getContractTypeId(): ?string
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
