<?php

namespace App\Entity;

use App\Repository\CompanyGroupRepository;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyGroupRepository::class)]
class CompanyGroup
{
    use TechnicalProperties;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $pubilshDate;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $status;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $creationYear;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $globalHrMail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $referralCode;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $turnover;

    #[ORM\Column(type: 'text', nullable: true)]
    private $usText;

    #[ORM\Column(type: 'text', nullable: true)]
    private $values;

    #[ORM\Column(type: 'text', nullable: true)]
    private $customersDesc;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $customersNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $website;

    #[ORM\Column(type: 'integer')]
    private $middleAge;

    #[ORM\Column(type: 'boolean')]
    private $careerWebsite;

    #[ORM\Column(type: 'boolean')]
    private $openToRecruitment;

    #[ORM\Column(type: 'string', length: 255)]
    private $color;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPubilshDate(): ?\DateTimeInterface
    {
        return $this->pubilshDate;
    }

    public function setPubilshDate(?\DateTimeInterface $pubilshDate): self
    {
        $this->pubilshDate = $pubilshDate;

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

    
}
