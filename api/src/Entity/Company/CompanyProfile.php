<?php

namespace App\Entity\Company;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Badge;
use App\Entity\ExpertiseField;
use App\Entity\JobType;
use App\Entity\Revision\CompanyProfileRevision;
use App\Entity\SocialFeed;
use App\Repository\CompanyRepositories\CompanyProfileRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use App\Transversal\Uuid;
use Doctrine\DBAL\Types\Types;
use App\Entity\Tool;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource]
#[ORM\Entity(repositoryClass: CompanyProfileRepository::class)]
class CompanyProfile
{
    use Uuid;

    #[ORM\Column(nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?int $creationYear = null;

    #[ORM\Column(nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?int $turnover = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?string $usText = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?string $values = null;

    #[ORM\Column(nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?int $customersNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?string $customersDesc = null;

    #[ORM\Column(nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?int $middleAge = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?SocialFeed $socialFeed = null;

    #[Validator\IsInRepository]
    #[ORM\Column(nullable: true)]
    private ?string $workforce = null;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $jobTypes;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $tools;

    #[ORM\OneToMany(mappedBy: 'CompanyProfile', targetEntity: CompanyProfileRevision::class, orphanRemoval: true)]
    private Collection $companyProfileRevisions;

    #[ORM\ManyToMany(targetEntity: Badge::class)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private Collection $badges;

    #[ORM\ManyToMany(targetEntity: ExpertiseField::class)]
    private Collection $expertiseFields;

    public function __construct()
    {
        $this->jobTypes = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->companyProfileRevisions = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->expertiseFields = new ArrayCollection();
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

    public function getCustomersNumber(): ?int
    {
        return $this->customersNumber;
    }

    public function setCustomersNumber(?int $customersNumber): self
    {
        $this->customersNumber = $customersNumber;

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

    public function getMiddleAge(): ?int
    {
        return $this->middleAge;
    }

    public function setMiddleAge(?int $middleAge): self
    {
        $this->middleAge = $middleAge;

        return $this;
    }

    public function getSocialFeed(): ?SocialFeed
    {
        return $this->socialFeed;
    }

    public function setSocialFeed(?SocialFeed $socialFeed): self
    {
        $this->socialFeed = $socialFeed;

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

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    public function getWorkforceLabel(): ?string
    {
        $workforceRepository = new WorkforceRepository();

        return $workforceRepository->find($this->workforce)->getLabel();
    }

    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS])]
    public function getNbBadges(): ?int
    {
        $nbBadges = count($this->getBadges());
        return $nbBadges;
    }


    /**
     * @return Collection<int, CompanyProfileRevision>
     */
    public function getCompanyProfileRevisions(): Collection
    {
        return $this->companyProfileRevisions;
    }

    public function addCompanyProfileRevision(CompanyProfileRevision $companyProfileRevision): self
    {
        if (!$this->companyProfileRevisions->contains($companyProfileRevision)) {
            $this->companyProfileRevisions->add($companyProfileRevision);
            $companyProfileRevision->setCompanyProfile($this);
        }

        return $this;
    }

    public function removeCompanyProfileRevision(CompanyProfileRevision $companyProfileRevision): self
    {
        $this->companyProfileRevisions->removeElement($companyProfileRevision);

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
     * @return Collection<int, ExpertiseField>
     */
    public function getExpertiseFields(): Collection
    {
        return $this->expertiseFields;
    }

    public function addExpertiseField(ExpertiseField $expertiseField): self
    {
        if (!$this->expertiseFields->contains($expertiseField)) {
            $this->expertiseFields->add($expertiseField);
        }

        return $this;
    }

    public function removeExpertiseField(ExpertiseField $expertiseField): self
    {
        $this->expertiseFields->removeElement($expertiseField);

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
}
