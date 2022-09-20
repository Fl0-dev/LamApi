<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\CompanyGroupController;
use App\Entity\Ats;
use App\Entity\Badge;
use App\Entity\Revision\CompanyGroupRevision;
use App\Entity\User\Employer;
use App\Entity\JobType;
use App\Entity\Media\Media;
use App\Entity\Organisation;
use App\Entity\Company\CompanyProfile;
use App\Entity\Social;
use App\Repository\CompanyRepositories\CompanyGroupRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use Symfony\Component\Uid\Uuid as BaseUuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyGroupRepository::class)]
#[ApiResource(
    collectionOperations: [
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS => [
            'method' => 'GET',
            'path' => '/company-groups/teasers',
            'openapi_context' => [],
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS],
            ],
        ],
        self::OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS => [
            'method' => 'GET',
            'path' => '/company-groups/name/keywords={keywords}',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS],
            ],
            'controller' => CompanyGroupController::class,
            'filters' => [],
            'openapi_context' => [
                'summary' => 'Retrieves list of CompanyGroups names by keywords',
                'description' => 'Retrieves list of CompanyGroups names by keywords',
                'parameters' => [
                    [
                        'name' => 'keywords',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        ],
    ],
    itemOperations: [
        ############################## GET DETAILS OF ONE COMPANYGROUP ##############################
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS => [
            'method' => 'GET',
            'path' => '/company-groups/{id}',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS],
            ],
        ],
        ############################## GET NUMBER OF COMPANYGROUPS ##############################
        self::OPERATION_NAME_COUNT_COMPANY_GROUPS => [
            'method' => 'GET',
            'path' => '/count-company-groups',
            'controller' => CompanyGroupController::class,
            'pagination_enabled' => false,
            'read' => false,
            'filters' => [],
            'openapi_context' => [
                'summary' => 'Count all company groups',
                'description' => 'Count all company groups. #withoutIdentifier',
                'parameters' => [],
                'responses' => [
                    '200' => [
                        'description' => 'Count all company groups',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'integer',
                                    'example' => 91,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ],
        ############################## GET ALL OFFERS BY COMPANYGROUP ID ##############################
        self::OPERATION_NAME_GET_COMPANY_OFFERS => [
            'method' => 'GET',
            'path' => '/company-groups/{id}/offers',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_COMPANY_OFFERS],
            ],
            'openapi_context' => [
                'summary' => 'Retrieves list of offers by company group id',
                'description' => 'Retrieves list of offers by company group id',
                'parameters' => [
                    [
                        'name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        ],
        ############################## GET ALL OFFICES BY COMPANYGROUP ID ##############################
        self::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID => [
            'method' => 'GET',
            'path' => '/company-groups/{id}/offices',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID],
            ],
            'openapi_context' => [
                'summary' => 'Retrieves list of offices by company group id',
                'description' => 'Retrieves list of offices by company group id',
                'parameters' => [
                    [
                        'name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        ],
        ############################## GET ALL APPLICATIONS BY COMPANYGROUP ID ##############################
        self::OPERATION_NAME_GET_COMPANY_APPLICATIONS => [
            'method' => 'GET',
            'path' => '/company-groups/{id}/applications',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_COMPANY_APPLICATIONS],
            ],
            'openapi_context' => [
                'summary' => 'Retrieves list of applications by company group id',
                'description' => 'Retrieves list of applications by company group id',
                'parameters' => [
                    [
                        'name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        ],
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'jobTypes',
        'name' => 'ipartial',
        'badges',
        'profile.tools',
        'profile.workforce', //slug exact match
        'companyEntities.companyEntityOffices.address.city', //uuid exact match
        'companyEntities.companyEntityOffices.address.city.department', //uuid exact match
    ]
)]
class CompanyGroup
{
    const OPERATION_NAME_COUNT_COMPANY_GROUPS = 'countCompanyGroups';
    const OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS = 'companyGroupsNameByKeywords';
    const OPERATION_NAME_GET_COMPANY_APPLICATIONS = 'getCompanyGroupApplications';
    const OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID = 'getCompanyGroupOffices';
    const OPERATION_NAME_GET_COMPANY_OFFERS = 'getCompanyGroupOffers';
    const OPERATION_NAME_GET_COMPANY_GROUP_DETAILS = 'getCompanyGroupDetails';
    const OPERATION_NAME_GET_COMPANY_GROUP_TEASERS = 'getCompanyGroupTeaser';

    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    /**
     * Uuid Property
     *
     */
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    #[ApiProperty(identifier: true)]
    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS])]
    private ?BaseUuid $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        self::OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS, 
        self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
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
        self::OPERATION_NAME_GET_COMPANY_OFFERS, 
        self::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID, 
        self::OPERATION_NAME_GET_COMPANY_APPLICATIONS
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

    /**
     * Get Uuid value
     */
    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    /**
     * Set Uuid value
     */
    public function setId(BaseUuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Check if Uuid has a valid value
     */
    public function hasId(): bool
    {
        return $this->id instanceof BaseUuid;
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

    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
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

    #[Groups([self::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, self::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
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
