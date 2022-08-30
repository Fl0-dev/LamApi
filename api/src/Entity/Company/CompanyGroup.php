<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\CompanyGroupController;
use App\Entity\Ats;
use App\Entity\Badge;
use App\Entity\User\Employer;
use App\Entity\JobType;
use App\Entity\Media\Media;
use App\Entity\Media\MediaImage;
use App\Entity\Organisation;
use App\Entity\Profile;
use App\Entity\Tool;
use App\Repository\CompanyRepositories\CompanyGroupRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyGroupRepository::class)]
#[ApiResource(
    collectionOperations: [
        'getCompanyGroupTeaser' => [
            'method' => 'GET',
            'path' => '/company-groups/teasers',
            'openapi_context' => [],
            'normalization_context' => [
                'groups' => ['read:getAllTeaserCompanyGroups'],
            ],
        ],
        self::OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS => [
            'method' => 'GET',
            'path' => '/company-groups/name/keywords={keywords}',
            'normalization_context' => [
                'groups' => ['read:getCompanyNameByKeyWords'],
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
        'getCompanyGroupDetails' => [
            'method' => 'GET',
            'path' => '/company-groups/{id}',
            'normalization_context' => [
                'groups' => ['read:getCompanyGroupDetails'],
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
        'getCompanyGroupOffers' => [
            'method' => 'GET',
            'path' => '/company-groups/{id}/offers',
            'normalization_context' => [
                'groups' => ['read:getCompanyGroupOffers'],
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
        'getCompanyGroupOffices' => [
            'method' => 'GET',
            'path' => '/company-groups/{id}/offices',
            'normalization_context' => [
                'groups' => ['read:getCompanyGroupOffices'],
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
        'getCompanyGroupApplications' => [
            'method' => 'GET',
            'path' => '/company-groups/{id}/applications',
            'normalization_context' => [
                'groups' => ['read:getCompanyGroupApplications'],
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
        'tools',
        'profile.workforce', //slug exact match
        'companyEntities.companyEntityOffices.address.city', //uuid exact match
        'companyEntities.companyEntityOffices.address.city.department', //uuid exact match
    ]
)]
class CompanyGroup
{
    const OPERATION_NAME_COUNT_COMPANY_GROUPS = 'countCompanyGroups';
    const OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS = 'companyGroupsNameByKeywords';

    use TechnicalProperties;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["read:getAllTeaserCompanyGroups", "read:getCompanyNameByKeyWords", 'read:getCompanyGroupDetails'])]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $publishDate;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $globalHrMail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $referralCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $website;

    #[ORM\Column(type: 'boolean')]
    private $careerWebsite;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $openToRecruitment;

    #[ORM\Column(type: 'string', length: 7)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $color;

    #[ORM\ManyToMany(targetEntity: Badge::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $badges;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $tools;

    #[ORM\ManyToMany(targetEntity: Organisation::class)]
    #[ORM\JoinTable(name: "company_group_pools")]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $pools;

    #[ORM\ManyToMany(targetEntity: Organisation::class)]
    #[ORM\JoinTable(name: "company_group_partners")]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $partners;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
    private $logo;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
    private $headerMedia;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $mainMedia;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $jobTypes;

    #[ORM\OneToMany(mappedBy: 'companyGroup', targetEntity: CompanyEntity::class, cascade: ['persist', 'remove'], fetch: 'EAGER')]
    #[Groups(['read:getCompanyGroupDetails', "read:getAllTeaserCompanyGroups", 'read:getCompanyGroupOffers', 'read:getCompanyGroupOffices', 'read:getCompanyGroupApplications'])]
    private $companyEntities;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\ManyToMany(targetEntity: Ats::class)]
    private Collection $ats;

    #[ORM\OneToMany(mappedBy: 'companyGroup', targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $medias;

    #[ORM\OneToOne(targetEntity: Profile::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
    private ?Profile $profile = null;

    public function __construct()
    {
        $this->badges = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->pools = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->jobTypes = new ArrayCollection();
        $this->companyEntities = new ArrayCollection();
        $this->admins = new ArrayCollection();
        $this->ats = new ArrayCollection();
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
            $this->tools[] = $tool;
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        $this->tools->removeElement($tool);

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

    public function getLogo(): ?MediaImage
    {
        return $this->logo;
    }

    public function setLogo(?MediaImage $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getHeaderMedia(): ?MediaImage
    {
        return $this->headerMedia;
    }

    public function setHeaderMedia(?MediaImage $headerMedia): self
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

    #[Groups(["read:getAllTeaserCompanyGroups"])]
    public function getNbBadges(): ?int
    {
        $nbBadges = count($this->getBadges());
        return $nbBadges;
    }

    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
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

    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
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
            $media->setCompanyGroup($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getCompanyGroup() === $this) {
                $media->setCompanyGroup(null);
            }
        }

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }
}
