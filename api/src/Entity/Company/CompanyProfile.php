<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
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

#[ORM\Entity(repositoryClass: CompanyProfileRepository::class)]
#[ApiResource()]
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

    #[Validator\IsInRepository()]
    #[ORM\Column(nullable: true)]
    private ?string $workforce = null;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $tools;

    #[ORM\OneToMany(mappedBy: 'CompanyProfile', targetEntity: CompanyProfileRevision::class, orphanRemoval: true)]
    private Collection $companyProfileRevisions;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->companyProfileRevisions = new ArrayCollection();
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
}
