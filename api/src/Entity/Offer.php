<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'boolean')]
    private $provided;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'boolean')]
    private $fullyTelework;

    #[ORM\Column(type: 'text')]
    private $missions;

    #[ORM\Column(type: 'text')]
    private $needs;

    #[ORM\Column(type: 'text')]
    private $prospectWithUs;

    #[ORM\Column(type: 'text')]
    private $recruitmentProcess;

    #[ORM\Column(type: 'text')]
    private $workWithUs;

    #[ORM\Column(type: 'float')]
    private $weeklyHours;

    #[ORM\Column(type: 'boolean')]
    private $startASAP;

    #[ORM\Column(type: 'float', nullable: true)]
    private $salaryMin;

    #[ORM\Column(type: 'float', nullable: true)]
    private $salaryMax;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $startDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $publishedAt;

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
}
