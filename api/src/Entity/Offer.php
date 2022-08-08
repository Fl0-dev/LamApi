<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CountOffers;
use App\Repository\OfferRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ApiResource(
    
    itemOperations: [
        ############################## GET TOTAL NUMBER OF OFFERS ##############################
        'CountOffers' => [
            'method' => 'GET',
            'path' => '/offers/count',
            'controller' => CountOffers::class,
            'pagination_enabled' => false,
            'read' => false,
            'filters' => [],
            'openapi_context' => [
                'summary' => 'Count all offers',
                'description' => 'Count all offers. #withoutIdentifier',
                'parameters'=> [],
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
        ############################## GET DETAILS OF ONE OFFER ##############################
        'GetOfferDetails' => [
            'method' => 'GET',
            'path' => '/offers/{id}',
            'normalization_context' => [
                'groups' => ['read:getOfferDetails'],
            ],  
        ]
    ]
)]
class Offer
{
    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['read:getOfferDetails'])]
    private $provided;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:getAllCompanyGroups", 'read:getOfferDetails'])]
    private $title;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['read:getOfferDetails'])]
    private $fullyTelework;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:getOfferDetails'])]
    private $missions;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:getOfferDetails'])]
    private $needs;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:getOfferDetails'])]
    private $prospectWithUs;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:getOfferDetails'])]
    private $recruitmentProcess;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:getOfferDetails'])]
    private $workWithUs;

    #[ORM\Column(type: 'float')]
    #[Groups(['read:getOfferDetails'])]
    private $weeklyHours;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['read:getOfferDetails'])]
    private $startASAP;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['read:getOfferDetails'])]
    private $salaryMin;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['read:getOfferDetails'])]
    private $salaryMax;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['read:getOfferDetails'])]
    private $startDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['read:getOfferDetails'])]
    private $publishedAt;

    #[ORM\ManyToOne(targetEntity: Ats::class)]
    private $ats;

    #[ORM\ManyToMany(targetEntity: JobBoard::class, inversedBy: 'offers')]
    private $jobBoards;

    #[ORM\OneToMany(mappedBy: 'offer', targetEntity: Application::class)]
    private $applications;

    #[ORM\ManyToOne(targetEntity: CompanyEntity::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:getOfferDetails'])]
    private $companyEntity;

    #[ORM\ManyToOne(targetEntity: Employer::class)]
    private $author;

    #[ORM\ManyToOne(targetEntity: Media::class)]
    #[Groups(['read:getOfferDetails'])]
    private $headerMedia;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    #[Groups(['read:getOfferDetails'])]
    private $levelOfStudy;

    #[ORM\ManyToOne(targetEntity: JobTitle::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:getOfferDetails'])]
    private $jobTitle;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read:getOfferDetails'])]
    private $experience;

    #[ORM\Column(type: 'string', length: 10)]
    #[Groups(['read:getOfferDetails'])]
    private $contractType;

    #[ORM\Column(type: 'string', length: 9)]
    private $status;

    public function __construct()
    {
        $this->jobBoards = new ArrayCollection();
        $this->applications = new ArrayCollection();
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

    public function getAts(): ?Ats
    {
        return $this->ats;
    }

    public function setAts(?Ats $ats): self
    {
        $this->ats = $ats;

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
            $application->setOffer($this);
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

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

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
        return $this->headerMedia;
    }

    public function setHeaderMedia(?Media $headerMedia): self
    {
        $this->headerMedia = $headerMedia;

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
}
