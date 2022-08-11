<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\CountCompanyGroups;
use App\Controller\GetCompanyGroupName;
use App\Filter\LocalisationFilter;
use App\Repository\CompanyGroupRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyGroupRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GetCompanyGroupTeaser' => [
            'method' => 'GET',
            'path' => '/company-groups/teasers',
            'openapi_context' => [],
            'normalization_context' => [
                'groups' => ['read:getAllTeaserCompanyGroups'],
            ],
        ],
        'getCompanyNameByKeyWords' => [
            'method' => 'GET',
            'path' => '/company-groups/name/keywords={keywords}',
            'normalization_context' => [
                'groups' => ['read:getCompanyNameByKeyWords'],
            ],
            'controller' => GetCompanyGroupName::class,
            'filters' => [],
            'openapi_context' => [
                'summary' => 'Retrives list of CompanyGroups names by keywords',
                'description' => 'Retrives list of CompanyGroups names by keywords',
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
        'GetCompanyGroupDetails' => [
            'method' => 'GET',
            'path' => '/company-groups/{id}',
            'normalization_context' => [
                'groups' => ['read:getCompanyGroupDetails'],
            ],  
        ],
        ############################## GET NUMBER OF COMPANYGROUPS ##############################
        'countCompanyGroups' => [
            'method' => 'GET',
            'path' => '/company-groups/count',
            'controller' => CountCompanyGroups::class,
            'pagination_enabled' => false,
            'read' => false,
            'filters' => [],
            'openapi_context' => [
                'summary' => 'Count all company groups',
                'description' => 'Count all company groups. #withoutIdentifier',
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
    ]
)]
#[ApiFilter(
    LocalisationFilter::class
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'jobTypes.slug' => 'ipartial',
        'name' => 'ipartial',
        'badges.slug' => 'ipartial',
        'tools.slug' => 'ipartial',
        'workforce.slug' => 'ipartial',
        //TODO: Fix for multiples fields
    ]
)]
class CompanyGroup
{
    use TechnicalProperties;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["read:getAllTeaserCompanyGroups", "read:getCompanyNameByKeyWords", 'read:getCompanyGroupDetails'])]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $publishDate;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $status;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $creationYear;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $globalHrMail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $referralCode;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $turnover;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $usText;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $values;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $customersDesc;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $customersNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $website;

    #[ORM\Column(type: 'integer')]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $middleAge;

    #[ORM\Column(type: 'boolean')]
    private $careerWebsite;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $openToRecruitment;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $color;

    #[ORM\ManyToMany(targetEntity: Badge::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $badges;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $tools;

    #[ORM\ManyToMany(targetEntity: Media::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $medias;

    #[ORM\ManyToMany(targetEntity: Organisation::class)]
    #[ORM\JoinTable(name: "company_group_pools")]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $pools;

    #[ORM\ManyToMany(targetEntity: Organisation::class)]
    #[ORM\JoinTable(name: "company_group_partners")]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $partners;

    #[ORM\OneToOne(targetEntity: Social::class, cascade: ['persist', 'remove'])]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $social;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
    private $logo;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
    private $headerMedia;

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $MainMedia;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $jobTypes;

    #[ORM\OneToMany(mappedBy: 'companyGroup', targetEntity: CompanyEntity::class, cascade: ['persist', 'remove'])]
    #[Groups(['read:getCompanyGroupDetails', "read:getAllTeaserCompanyGroups"])]
    private $companyEntities;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\OneToMany(mappedBy: 'companyGroup', targetEntity: CompanyGroupTeam::class)]
    #[Groups(['read:getCompanyGroupDetails'])]
    private $companyGroupTeams;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(["read:getAllTeaserCompanyGroups", 'read:getCompanyGroupDetails'])]
    private $workforce;

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
        $this->companyGroupTeams = new ArrayCollection();
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

    public function getCreationYear(): ?int
    {
        return $this->creationYear;
    }

    public function setCreationYear(?int $creationYear): self
    {
        $this->creationYear = $creationYear;

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

    public function getTurnover(): ?int
    {
        return $this->turnover;
    }

    public function setTurnover(?int $turnover): self
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getUsText(): ?string
    {
        return $this->usText;
    }

    public function setUsText(?string $usText): self
    {
        $this->usText = $usText;

        return $this;
    }

    public function getValues(): ?string
    {
        return $this->values;
    }

    public function setValues(?string $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function getCustomersDesc(): ?string
    {
        return $this->customersDesc;
    }

    public function setCustomersDesc(?string $customersDesc): self
    {
        $this->customersDesc = $customersDesc;

        return $this;
    }

    public function getCustomersNumber(): ?int
    {
        return $this->customersNumber;
    }

    public function setCustomersNumber(?int $customersNumber): self
    {
        $this->customersNumber = $customersNumber;

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

    public function getMiddleAge(): ?int
    {
        return $this->middleAge;
    }

    public function setMiddleAge(int $middleAge): self
    {
        $this->middleAge = $middleAge;

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
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        $this->medias->removeElement($media);

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

    public function getSocial(): ?Social
    {
        return $this->social;
    }

    public function setSocial(?Social $social): self
    {
        $this->social = $social;

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
        return $this->MainMedia;
    }

    public function setMainMedia(?Media $MainMedia): self
    {
        $this->MainMedia = $MainMedia;

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

    /**
     * @return Collection<int, CompanyGroupTeam>
     */
    public function getCompanyGroupTeams(): Collection
    {
        return $this->companyGroupTeams;
    }

    public function addCompanyGroupTeam(CompanyGroupTeam $companyGroupTeam): self
    {
        if (!$this->companyGroupTeams->contains($companyGroupTeam)) {
            $this->companyGroupTeams[] = $companyGroupTeam;
            $companyGroupTeam->setCompanyGroup($this);
        }

        return $this;
    }

    public function removeCompanyGroupTeam(CompanyGroupTeam $companyGroupTeam): self
    {
        if ($this->companyGroupTeams->removeElement($companyGroupTeam)) {
            // set the owning side to null (unless already changed)
            if ($companyGroupTeam->getCompanyGroup() === $this) {
                $companyGroupTeam->setCompanyGroup(null);
            }
        }

        return $this;
    }

    public function getWorkforce(): ?string
    {
        return $this->workforce;
    }

    public function setWorkforce(?string $workforce): self
    {
        $this->workforce = $workforce;

        return $this;
    }

    #[Groups(["read:getAllTeaserCompanyGroups"])]
    public function getNbBadges(): ?int
    {
        $nbBadges = count($this->getBadges());
        return $nbBadges;
    }

    #[Groups(["read:getAllTeaserCompanyGroups"])]
    public function getNbOffers(): ?int
    {
        $companyEntities = $this->getCompanyEntities();
        $nbOffers = 0;
        foreach ($companyEntities as $companyEntity) {
            $nbOffers += count($companyEntity->getOffers());
        }
        return $nbOffers;
    }
}
