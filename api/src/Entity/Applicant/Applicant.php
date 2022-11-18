<?php

namespace App\Entity\Applicant;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\PostApplicant;
use App\Entity\Application\Application;
use App\Entity\Location\City;
use App\Entity\JobTitle;
use App\Entity\References\ApplicantStatus;
use App\Entity\References\ContractType;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Entity\Subscriptions\Applicant\ApplicantSubscription;
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
    new GetCollection(),
    new Get(),
    new Get(
        security: "is_granted('ROLE_ADMIN')",
        uriTemplate: '/applicant/{id}/applications',
        normalizationContext: ['groups' => [self::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID]],
        openapiContext: [
            'summary' => 'Get all applications by applicant id',
        ],
    ),
    new Patch(),
    new Put(),
    new Delete(),
    new Post(
        uriTemplate: '/applicants',
        controller: PostApplicant::class,
        denormalizationContext: ['groups' => [self::OPERATION_NAME_POST_APPLICANT]],
        openapiContext: [
            'tags' => ['Applicant'],
            'summary' => 'Create applicant',
        ],
    ),
])]
#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
#[ORM\Table(name: "applicant")]
class Applicant extends UserPhysical
{
    public const OPERATION_NAME_GET_ALL_APPLICANTS = 'getApplicants';
    public const OPERATION_NAME_POST_APPLICANT = 'postApplicant';
    public const OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID = 'getApplicationsByApplicantId';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $defaultMotivationText;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_APPLICANTS,
    ])]
    private $linkedin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $providedFrom;

    #[ORM\OneToMany(mappedBy: 'applicant', targetEntity: ApplicantCv::class)]
    private $applicantCvs;

    #[ORM\OneToMany(mappedBy: 'applicant', targetEntity: Application::class)]
    #[Groups([
        self::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    private $applications;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $currentLevelOfStudy;

    #[ORM\ManyToOne(targetEntity: JobTitle::class)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $currentJobTitle;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $currentExperience;

    #[ORM\ManyToOne(targetEntity: City::class)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $currentCity;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    private $currentContractType;

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

    #[ORM\OneToOne(mappedBy: 'applicant', cascade: ['persist', 'remove'])]
    private ?ApplicantSubscription $applicantSubscription = null;

    public function __construct()
    {
        parent::__construct();
        $this->applicantCvs = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->status = (new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId();
    }

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getCurrentContractType(): ?string
    {
        $contractTypeRepository = new ContractTypeRepository();
        $currentContractType = $contractTypeRepository->find($this->currentContractType);

        return $currentContractType instanceof ContractType ? $currentContractType->getLabel() : null;
    }

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getCurrentExperience(): ?string
    {
        $experienceRepository = new ExperienceRepository();
        $currentExperience = $experienceRepository->find($this->currentExperience);

        return $currentExperience instanceof Experience ? $currentExperience->getDuration() : null;
    }

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getCurrentLevelOfStudy(): ?string
    {
        $levelOfStudyRepository = new LevelOfStudyRepository();
        $currentLevelOfStudy = $levelOfStudyRepository->find($this->currentLevelOfStudy);

        return $currentLevelOfStudy instanceof LevelOfStudy ? $currentLevelOfStudy->getLabel() : null;
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
    public function getCurrentLevelOfStudyId(): ?string
    {
        return $this->currentLevelOfStudy;
    }

    public function setCurrentLevelOfStudy(?string $currentLevelOfStudy): self
    {
        $this->currentLevelOfStudy = $currentLevelOfStudy;

        return $this;
    }

    public function getCurrentJobTitle(): ?JobTitle
    {
        return $this->currentJobTitle;
    }

    public function setCurrentJobTitle(?JobTitle $currentJobTitle): self
    {
        $this->currentJobTitle = $currentJobTitle;

        return $this;
    }

    #[Groups([self::OPERATION_NAME_GET_ALL_APPLICANTS])]
    public function getCurrentExperienceId(): ?string
    {
        return $this->currentExperience;
    }

    public function setCurrentExperience(?string $currentExperience): self
    {
        $this->currentExperience = $currentExperience;

        return $this;
    }

    public function getCurrentCity(): ?City
    {
        return $this->currentCity;
    }

    public function setCurrentCity(?City $currentCity): self
    {
        $this->currentCity = $currentCity;

        return $this;
    }

    public function getCurrentContractTypeId(): ?string
    {
        return $this->currentContractType;
    }

    public function setCurrentContractType(?string $currentContractType): self
    {
        $this->currentContractType = $currentContractType;

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

    public function getApplicantSubscription(): ?ApplicantSubscription
    {
        return $this->applicantSubscription;
    }

    public function setApplicantSubscription(ApplicantSubscription $applicantSubscription): self
    {
        // set the owning side of the relation if necessary
        if ($applicantSubscription->getApplicant() !== $this) {
            $applicantSubscription->setApplicant($this);
        }

        $this->applicantSubscription = $applicantSubscription;

        return $this;
    }
}
