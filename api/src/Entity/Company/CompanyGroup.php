<?php

namespace App\Entity\Company;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Controller\CompanyGroupController;
use App\Entity\Ats;
use App\Entity\Badge;
use App\Entity\Revision\CompanyGroupRevision;
use App\Entity\User\Employer;
use App\Entity\JobType;
use App\Entity\Media\Media;
use App\Entity\Organisation;
use App\Entity\Company\CompanyProfile;
use App\Entity\JobBoard;
use App\Entity\Social;
use App\Repository\CompanyRepositories\CompanyGroupRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid as BaseUuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new Get(
        uriTemplate: '/company-groups/{id}',
        normalizationContext: [
            'groups' => ['getCompanyGroupDetails']
        ]
    ), new Get(
        uriTemplate: '/count-company-groups',
        controller: CompanyGroupController::class,
        paginationEnabled: false,
        read: false,
        filters: [],
        openapiContext: [
            'summary' => 'Count all company groups',
            'description' => 'Count all company groups. #withoutIdentifier',
            'parameters' => [],
            'responses' => [
                [
                    'description' => 'Count all company groups',
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'integer',
                                'example' => 91
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ),
    new Get(
        uriTemplate: '/company-groups/{id}/offers',
        normalizationContext: [
            'groups' => [
                'getCompanyGroupOffers'
            ]
        ],
        openapiContext: [
            'summary' => 'Retrieves list of offers by company group id',
            'description' => 'Retrieves list of offers by company group id',
            'parameters' => [
                [
                    'name' => 'id',
                    'in' => 'path',
                    'required' => true,
                    'schema' => ['type' => 'string']
                ]
            ]
        ]
    ),
    new Get(
        uriTemplate: '/company-groups/{id}/offices',
        normalizationContext: [
            'groups' => ['getCompanyGroupOffices']
        ],
        openapiContext: [
            'summary' => 'Retrieves list of offices by company group id',
            'description' => 'Retrieves list of offices by company group id',
            'parameters' => [
                [
                    'name' => 'id',
                    'in' => 'path',
                    'required' => true,
                    'schema' => [
                        'type' => 'string'
                    ]
                ]
            ]
        ]
    ),
    new Get(
        uriTemplate: '/company-groups/{id}/applications',
        normalizationContext: [
            'groups' => ['getCompanyGroupApplications']
        ],
        openapiContext: [
            'summary' => 'Retrieves list of applications by company group id',
            'description' => 'Retrieves list of applications by company group id',
            'parameters' => [
                [
                    'name' => 'id',
                    'in' => 'path',
                    'required' => true,
                    'schema' => [
                        'type' => 'string'
                    ]
                ]
            ]
        ]
    ),
    new GetCollection(
        uriTemplate: '/company-groups/teasers',
        openapiContext: [],
        normalizationContext: [
            'groups' => ['getCompanyGroupTeaser']
        ]
    ),
    new GetCollection(
        uriTemplate: '/company-groups/name/keywords={keywords}',
        normalizationContext: [
            'groups' => ['companyGroupsNameByKeywords']
        ],
        controller: CompanyGroupController::class,
        filters: [],
        openapiContext: [
            'summary' => 'Retrieves list of CompanyGroups names by keywords',
            'description' => 'Retrieves list of CompanyGroups names by keywords',
            'parameters' => [
                [
                    'name' => 'keywords',
                    'in' => 'path',
                    'required' => true,
                    'schema' => [
                        'type' => 'string'
                    ]
                ]
            ]
        ]
    )
])]
#[ORM\Entity(repositoryClass: CompanyGroupRepository::class)]
#[ApiFilter(
    filterClass: SearchFilter::class,
    properties: [
        'jobTypes',
        'name' => 'ipartial',
        'badges', 'profile.tools',
        'profile.workforce',
        'companyEntities.companyEntityOffices.address.city',
        'companyEntities.companyEntityOffices.address.city.department'
    ]
)]
class CompanyGroup
{
    const OPERATION_NAME_COUNT_COMPANY_GROUPS = 'countCompanyGroups';
    const OPERATION_NAME_GET_COMPANY_NAME_BY_KEYWORDS = 'companyGroupsNameByKeywords';
    const OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID = 'getCompanyGroupApplications';
    const OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID = 'getCompanyGroupOffices';
    const OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID = 'getCompanyGroupOffers';
    const OPERATION_NAME_GET_COMPANY_GROUP_DETAILS = 'getCompanyGroupDetails';
    const OPERATION_NAME_GET_COMPANY_GROUP_TEASERS = 'getCompanyGroupTeaser';

    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_COMPANY_NAME_BY_KEYWORDS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $publishDate;

    #[ORM\Column(type: 'string', nullable: true)]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $globalHrMail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $referralCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $website;

    #[ORM\Column(type: 'boolean')]
    private $careerWebsite;

    #[ORM\Column(type: 'boolean')]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $openToRecruitment;

    #[ORM\Column(type: 'string', length: 7)]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $color;

    #[ORM\ManyToMany(targetEntity: Organisation::class)]
    #[ORM\JoinTable(name: "company_group_pool")]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $pools;

    #[ORM\ManyToMany(targetEntity: Organisation::class)]
    #[ORM\JoinTable(name: "company_group_partner")]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $partners;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    private $logo;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    private $headerMedia;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $mainMedia;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $jobTypes;

    #[ORM\OneToMany(mappedBy: 'companyGroup', targetEntity: CompanyEntity::class, cascade: ['persist', 'remove'], fetch: 'EAGER')]
    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID,
        self::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID
    ])]
    private $companyEntities;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\ManyToMany(targetEntity: Ats::class)]
    private Collection $ats;

    #[ORM\OneToOne(targetEntity: CompanyProfile::class, cascade: ['persist', 'remove'])]
    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    private ?CompanyProfile $profile = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?Social $social = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subscriptionType = null;

    #[ORM\ManyToMany(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinTable(name: "company_group_has_media")]
    #[ORM\JoinColumn(name: "companyGroup_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "media_id", referencedColumnName: "id", unique: true)]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private Collection $medias;

    #[ORM\OneToMany(mappedBy: 'companyGroup', targetEntity: CompanyGroupRevision::class, orphanRemoval: true)]
    private Collection $companyGroupRevisions;
    #[ORM\ManyToMany(targetEntity: Badge::class)]
    private Collection $badges;

    public function __construct()
    {
        $this->pools = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->jobTypes = new ArrayCollection();
        $this->companyEntities = new ArrayCollection();
        $this->admins = new ArrayCollection();
        $this->ats = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->companyGroupRevisions = new ArrayCollection();
        $this->badges = new ArrayCollection();
    }

    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }

    public function setPublishDate(?\DateTimeInterface $publishDate): self
    {
        $this->publishDate = $publishDate;
        return $this;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getGlobalHrMail(): ?string
    {
        return $this->globalHrMail;
    }

    public function setGlobalHrMail(?string $globalHrMail): self
    {
        $this->globalHrMail = $globalHrMail;
        return $this;
    }

    public function getReferralCode(): ?string
    {
        return $this->referralCode;
    }

    public function setReferralCode(?string $referralCode): self
    {
        $this->referralCode = $referralCode;
        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;
        return $this;
    }

    public function isCareerWebsite(): ?bool
    {
        return $this->careerWebsite;
    }

    public function setCareerWebsite(bool $careerWebsite): self
    {
        $this->careerWebsite = $careerWebsite;
        return $this;
    }

    public function isOpenToRecruitment(): ?bool
    {
        return $this->openToRecruitment;
    }

    public function setOpenToRecruitment(bool $openToRecruitment): self
    {
        $this->openToRecruitment = $openToRecruitment;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return Collection<int, Organisation>
     */
    public function getPools(): Collection
    {
        return $this->pools;
    }

    public function addPool(Organisation $pool): self
    {
        if (!$this->pools->contains($pool)) {
            $this->pools[] = $pool;
        }
        return $this;
    }

    public function removePool(Organisation $pool): self
    {
        $this->pools->removeElement($pool);
        return $this;
    }

    /**
     * @return Collection<int, Organisation>
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Organisation $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
        }
        return $this;
    }

    public function removePartner(Organisation $partner): self
    {
        $this->partners->removeElement($partner);
        return $this;
    }

    public function getLogo(): ?Media
    {
        return $this->logo;
    }

    public function setLogo(?Media $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function getHeaderMedia(): ?Media
    {
        return $this->headerMedia;
    }

    public function setHeaderMedia(?Media $headerMedia): self
    {
        $this->headerMedia = $headerMedia;
        return $this;
    }

    public function getMainMedia(): ?Media
    {
        return $this->mainMedia;
    }

    public function setMainMedia(?Media $mainMedia): self
    {
        $this->mainMedia = $mainMedia;
        return $this;
    }

    /**
     * @return Collection<int, JobType>
     */
    public function getJobTypes(): Collection
    {
        return $this->jobTypes;
    }

    public function addJobType(JobType $jobType): self
    {
        if (!$this->jobTypes->contains($jobType)) {
            $this->jobTypes[] = $jobType;
        }
        return $this;
    }

    public function removeJobType(JobType $jobType): self
    {
        $this->jobTypes->removeElement($jobType);
        return $this;
    }

    /**
     * @return Collection<int, CompanyEntity>
     */
    public function getCompanyEntities(): Collection
    {
        return $this->companyEntities;
    }

    public function addCompanyEntity(CompanyEntity $companyEntity): self
    {
        if (!$this->companyEntities->contains($companyEntity)) {
            $this->companyEntities[] = $companyEntity;
            $companyEntity->setCompanyGroup($this);
        }
        return $this;
    }

    public function removeCompanyEntity(CompanyEntity $companyEntity): self
    {
        if ($this->companyEntities->removeElement($companyEntity)) {
            // set the owning side to null (unless already changed)
            if ($companyEntity->getCompanyGroup() === $this) {
                $companyEntity->setCompanyGroup(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Employer>
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Employer $admin): self
    {
        if (!$this->admins->contains($admin)) {
            $this->admins[] = $admin;
        }
        return $this;
    }

    public function removeAdmin(Employer $admin): self
    {
        $this->admins->removeElement($admin);
        return $this;
    }

    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS])]
    public function getNbBadges(): ?int
    {
        $nbBadges = count($this->getBadges());
        return $nbBadges;
    }

    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    public function getNbOffers(): ?int
    {
        $companyEntities = $this->getCompanyEntities();
        $nbOffers = 0;
        foreach ($companyEntities as $companyEntity) {
            foreach ($companyEntity->getCompanyEntityOffices() as $office) {
                $nbOffers += count($office->getOffers());
            }
        }
        return $nbOffers;
    }

    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    public function getNbCompanyEntityOffices(): ?int
    {
        $companyEntities = $this->getCompanyEntities();
        $nbOffices = 0;
        foreach ($companyEntities as $companyEntity) {
            $nbOffices += count($companyEntity->getCompanyEntityOffices());
        }
        return $nbOffices;
    }

    /**
     * @return Collection<int, Ats>
     */
    public function getAts(): Collection
    {
        return $this->ats;
    }

    public function addAts(Ats $ats): self
    {
        if (!$this->ats->contains($ats)) {
            $this->ats->add($ats);
        }
        return $this;
    }

    public function removeAts(Ats $ats): self
    {
        $this->ats->removeElement($ats);
        return $this;
    }

    public function getProfile(): ?CompanyProfile
    {
        return $this->profile;
    }

    public function setProfile(?CompanyProfile $profile): self
    {
        $this->profile = $profile;
        
        return $this;
    }

    public function getSocial(): ?Social
    {
        return $this->social;
    }

    public function setSocial(?Social $social): self
    {
        $this->social = $social;

        return $this;
    }

    public function getSubscriptionType(): ?string
    {
        return $this->subscriptionType;
    }

    public function setSubscriptionType(?string $subscriptionType): self
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        $this->medias->removeElement($media);

        return $this;
    }

    /**
     * @return Collection<int, CompanyGroupRevision>
     */
    public function getCompanyGroupRevisions(): Collection
    {
        return $this->companyGroupRevisions;
    }

    public function addCompanyGroupRevision(CompanyGroupRevision $CompanyGroupRevision): self
    {
        if (!$this->companyGroupRevisions->contains($CompanyGroupRevision)) {
            $this->companyGroupRevisions->add($CompanyGroupRevision);
            $CompanyGroupRevision->setCompanyGroup($this);
        }

        return $this;
    }

    public function removeCompanyGroupRevision(CompanyGroupRevision $CompanyGroupRevision): self
    {
        $this->companyGroupRevisions->removeElement($CompanyGroupRevision);

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges[] = $badge;
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        $this->badges->removeElement($badge);

        return $this;
    }
}
