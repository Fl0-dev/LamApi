<?php

namespace App\Entity\Offer;

use ApiPlatform\Core\Annotation\ApiFilter;
use App\Entity\Revision\OfferRevision;
use App\Validator;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\OfferController;
use App\Entity\Application\Application;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyGroup;
use App\Entity\User\Employer;
use App\Entity\JobBoard;
use App\Entity\JobTitle;
use App\Entity\Media\Media;
use App\Entity\References\ContractType;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Entity\References\OfferStatus;
use App\Entity\Tool;
use App\Entity\User\User;
use App\Repository\OfferRepositories\OfferRepository;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Symfony\Component\Uid\Uuid as BaseUuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ApiResource(
    collectionOperations: [
        self::OPERATION_NAME_GET_ALL_OFFER => [
            'method' => 'GET',
            'path' => '/offers/all',
            'normalization_context' => [
                'groups' => [
                    self::OPERATION_NAME_GET_ALL_OFFER
                ]
            ]
        ],
        self::OPERATION_NAME_GET_OFFER_TEASERS => [
            'method' => 'GET',
            'path' => '/offers/teasers',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_OFFER_TEASERS],
            ],
        ],
        ############################## SAVE OR UPDATE OFFER ##############################
        self::OPERATION_NAME_POST_OFFER => [
            'method' => 'POST',
            'path' => '/offers',
            'controller' => OfferController::class,
            'denormalization_context' => [
                'groups' => [self::OPERATION_NAME_POST_OFFER],
            ],
        ],
    ],
    itemOperations: [
        ############################## GET DETAILS OF ONE OFFER ##############################
        self::OPERATION_NAME_GET_OFFER_DETAILS => [
            'method' => 'GET',
            'path' => '/offers/{id}',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_OFFER_DETAILS],
            ],
        ],
        ############################## GET ALL APPLICATIONS BY OFFER ID ##############################
        self::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID => [
            'method' => 'GET',
            'path' => '/offers/{id}/applications',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID],
            ],
            'openapi_context' => [
                'summary' => 'Retrieves all applications by offer id',
                'description' => 'Retrieves all applications by offer id',
            ],
        ],
        ############################## GET TOTAL NUMBER OF OFFERS ##############################
        self::OPERATION_NAME_COUNT_OFFERS => [
            'method' => 'GET',
            'path' => '/offers-count',
            'controller' => OfferController::class,
            'pagination_enabled' => false,
            'read' => false,
            'filters' => [],
            'openapi_context' => [
                'summary' => 'Count all offers',
                'description' => 'Count all offers. #withoutIdentifier',
                'parameters' => [],
                'responses' => [
                    '200' => [
                        'description' => 'Count all offers',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'integer',
                                    'example' => 271,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ],
    ]
)]
#[ApiFilter(OrderFilter::class, properties: ['publishedAt' => 'desc'])]
#[ApiFilter(BooleanFilter::class, properties: ['provided' => false])]
#[
    ApiFilter(
        SearchFilter::class,
        properties: [
            'contractType',
            'jobTitle',
            'experience',
            'companyEntityOffice.companyEntity.companyGroup.id' => 'exact',
            'companyEntityOffice.address.city',
            'companyEntityOffice.address.city.department',
        ]
    )
]
class Offer
{
    const OPERATION_NAME_GET_ALL_OFFER = 'getAllOffers';
    const OPERATION_NAME_GET_OFFER_TEASERS = 'getOfferTeasers';
    const OPERATION_NAME_POST_OFFER = 'postOffer';
    const OPERATION_NAME_COUNT_OFFERS = 'countOffers';
    const OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID = 'getOfferApplications';
    const OPERATION_NAME_GET_OFFER_DETAILS = 'getOfferDetails';

    use Uuid;
    use Slug;
    use LastModifiedDate;
    use CreatedDate;

    #[ORM\Column(type: 'boolean')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    private $provided;

    #[ORM\Column(type: 'string', length: 255)]
    #[
        Groups([
            self::OPERATION_NAME_GET_ALL_OFFER,
            self::OPERATION_NAME_GET_OFFER_DETAILS,
            self::OPERATION_NAME_GET_OFFER_TEASERS,
            CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
            JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
            self::OPERATION_NAME_POST_OFFER
        ]),
        Length(
            min: 3,
            max: 255,
            minMessage: "Le titre de l'offre doit contenir au moins {{ limit }} caractères",
            maxMessage: "Le titre de l'offre ne doit pas dépasser {{ limit }} caractères"
        )
    ]
    private $title;

    #[ORM\Column(type: 'boolean')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $fullyTelework;

    #[ORM\Column(type: 'text')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $missions;

    #[ORM\Column(type: 'text')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $needs;

    #[ORM\Column(type: 'text')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $prospectWithUs;

    #[ORM\Column(type: 'text')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $recruitmentProcess;

    #[ORM\Column(type: 'text')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $workWithUs;

    #[ORM\Column(type: 'float')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $weeklyHours;

    #[ORM\Column(type: 'boolean')]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_OFFER_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $startASAP;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_OFFER_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $salaryMin;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_OFFER_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $salaryMax;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_OFFER_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $startDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_OFFER_DETAILS])]
    private $publishedAt;

    #[ORM\ManyToMany(targetEntity: JobBoard::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: true)]
    private $jobBoards;

    #[ORM\OneToMany(mappedBy: 'offer', targetEntity: Application::class)]
    #[Groups([
        self::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    #[ORM\JoinColumn(nullable: true)]
    private $applications;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private $author;

    #[ORM\ManyToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_OFFER_TEASERS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    private $headerMedia;

    #[Validator\IsInRepository()]
    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $levelOfStudy;

    #[ORM\ManyToOne(targetEntity: JobTitle::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $jobTitle;

    #[Validator\IsInRepository()]
    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $experience;

    #[Validator\IsInRepository()]
    #[ORM\Column(type: 'string', nullable: false)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private $contractType;

    #[ORM\Column(type: 'string', nullable: false)]
    private $status;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    #[Groups([
        self::OPERATION_NAME_GET_OFFER_DETAILS, 
        self::OPERATION_NAME_POST_OFFER
    ])]
    private Collection $tools;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_OFFER,
        self::OPERATION_NAME_GET_OFFER_DETAILS,
        self::OPERATION_NAME_GET_OFFER_TEASERS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        self::OPERATION_NAME_POST_OFFER
    ])]
    private ?CompanyEntityOffice $companyEntityOffice = null;

    #[ORM\OneToMany(mappedBy: 'offer', targetEntity: OfferRevision::class, orphanRemoval: true)]
    private Collection $offerRevisions;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->jobBoards = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->createdDate = new \DateTime();
        $this->lastModifiedDate = new \DateTime();
        $this->provided = false;
        $this->publishedAt = null;
        $this->status = OfferStatus::DRAFT;
        $this->offerRevisions = new ArrayCollection();
    }

    #[Groups([self::OPERATION_NAME_GET_OFFER_TEASERS])]
    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    // #[Groups([self::OPERATION_NAME_POST_OFFER])]
    // public function setSlug(): ?string
    // {
    //     return $this->slug;
    // }

    #[Groups([
        self::OPERATION_NAME_GET_OFFER_DETAILS, 
        self::OPERATION_NAME_GET_OFFER_TEASERS, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    public function getContractTypeLabel(): ?string
    {
        $contractTypeRepository = new ContractTypeRepository();
        $contractType = $contractTypeRepository->find($this->contractType);

        return $contractType instanceof ContractType ? $contractType->getLabel() : null;
    }

    #[Groups([
        self::OPERATION_NAME_GET_OFFER_DETAILS, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    public function getExperienceLabel(): ?string
    {
        $experienceRepository = new ExperienceRepository();
        $experience = $experienceRepository->find($this->experience);

        return $experience instanceof Experience ? $experience->getDuration() : null;
    }

    #[Groups([
        self::OPERATION_NAME_GET_OFFER_DETAILS, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    public function getLevelOfStudyLabel(): ?string
    {
        $levelOfStudyRepository = new LevelOfStudyRepository();
        $levelOfStudy = $levelOfStudyRepository->find($this->levelOfStudy);

        return $levelOfStudy instanceof LevelOfStudy ? $levelOfStudy->getLabel() : null;
    }

    public function isProvided(): ?bool
    {
        return $this->provided;
    }

    public function setProvided(bool $provided): self
    {
        $this->provided = $provided;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function isFullyTelework(): ?bool
    {
        return $this->fullyTelework;
    }

    public function setFullyTelework(bool $fullyTelework): self
    {
        $this->fullyTelework = $fullyTelework;

        return $this;
    }

    public function getMissions(): ?string
    {
        return $this->missions;
    }

    public function setMissions(string $missions): self
    {
        $this->missions = $missions;

        return $this;
    }

    public function getNeeds(): ?string
    {
        return $this->needs;
    }

    public function setNeeds(string $needs): self
    {
        $this->needs = $needs;

        return $this;
    }

    public function getProspectWithUs(): ?string
    {
        return $this->prospectWithUs;
    }

    public function setProspectWithUs(string $prospectWithUs): self
    {
        $this->prospectWithUs = $prospectWithUs;

        return $this;
    }

    public function getRecruitmentProcess(): ?string
    {
        return $this->recruitmentProcess;
    }

    public function setRecruitmentProcess(string $recruitmentProcess): self
    {
        $this->recruitmentProcess = $recruitmentProcess;

        return $this;
    }

    public function getWorkWithUs(): ?string
    {
        return $this->workWithUs;
    }

    public function setWorkWithUs(string $workWithUs): self
    {
        $this->workWithUs = $workWithUs;

        return $this;
    }

    public function getWeeklyHours(): ?float
    {
        return $this->weeklyHours;
    }

    public function setWeeklyHours(float $weeklyHours): self
    {
        $this->weeklyHours = $weeklyHours;

        return $this;
    }

    public function isStartASAP(): ?bool
    {
        return $this->startASAP;
    }

    public function setStartASAP(bool $startASAP): self
    {
        $this->startASAP = $startASAP;

        return $this;
    }

    public function getSalaryMin(): ?float
    {
        return $this->salaryMin;
    }

    public function setSalaryMin(?float $salaryMin): self
    {
        $this->salaryMin = $salaryMin;

        return $this;
    }

    public function getSalaryMax(): ?float
    {
        return $this->salaryMax;
    }

    public function setSalaryMax(?float $salaryMax): self
    {
        $this->salaryMax = $salaryMax;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return Collection<int, JobBoard>
     */
    public function getJobBoards(): Collection
    {
        return $this->jobBoards;
    }

    public function addJobBoard(JobBoard $jobBoard): self
    {
        if (!$this->jobBoards->contains($jobBoard)) {
            $this->jobBoards[] = $jobBoard;
        }

        return $this;
    }

    public function removeJobBoard(JobBoard $jobBoard): self
    {
        $this->jobBoards->removeElement($jobBoard);

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
            $application->setOffer($this->offer);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getOffer() === $this) {
                $application->setOffer(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?Employer
    {
        return $this->author;
    }

    public function setAuthor(?Employer $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getHeaderMedia(): ?Media
    {
        if ($this->headerMedia) {
            return $this->headerMedia;
        } else {
            return $this->companyEntityOffice->getCompanyEntity()->getCompanyGroup()->getHeaderMedia();
        }
    }

    public function setHeaderMedia(?Media $headerMedia): self
    {
        if ($this->headerMedia) {
            $this->headerMedia = $headerMedia;
        } else {
            $this->headerMedia = $this->companyEntityOffice->getCompanyEntity()->getCompanyGroup()->getHeaderMedia();
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

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contractType;
    }

    public function setContractType(string $contractType): self
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

    /**
     * @return Collection<int, Tool>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools->add($tool);
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        $this->tools->removeElement($tool);

        return $this;
    }

    public function getCompanyEntityOffice(): ?CompanyEntityOffice
    {
        return $this->companyEntityOffice;
    }

    public function setCompanyEntityOffice(?CompanyEntityOffice $companyEntityOffice): self
    {
        $this->companyEntityOffice = $companyEntityOffice;

        return $this;
    }

    /**
     * @return Collection<int, OfferRevision>
     */
    public function getOfferRevisions(): Collection
    {
        return $this->offerRevisions;
    }

    public function addOfferRevision(OfferRevision $offerRevision): self
    {
        if (!$this->offerRevisions->contains($offerRevision)) {
            $this->offerRevisions->add($offerRevision);
            $offerRevision->setOffer($this);
        }

        return $this;
    }

    public function removeOfferRevision(OfferRevision $offerRevision): self
    {
        $this->offerRevisions->removeElement($offerRevision);

        return $this;
    }
}
