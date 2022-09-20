<?php

namespace App\Entity\Application;

use App\Entity\Applicant\ApplicantCv;
use App\Entity\User\Employer;
use App\Repository\ApplicationRepositories\ApplicationHistoryRepository;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationHistoryRepository::class)]
class ApplicationHistory
{
    use Uuid;
    use LastModifiedDate;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne]
    private ?Employer $employer = null;

    #[ORM\ManyToOne]
    private ?Application $application = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private $motivationText;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score;

    #[ORM\Column(nullable: true)]
    private ?string $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApplicantCv $cv = null;

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getEmployer(): ?Employer
    {
        return $this->employer;
    }

    public function setEmployer(?Employer $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

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

    public function getMotivationText(): ?string
    {
        return $this->motivationText;
    }

    public function setMotivationText(?string $motivationText): self
    {
        $this->motivationText = $motivationText;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getCv(): ?ApplicantCv
    {
        return $this->cv;
    }

    public function setCv(?ApplicantCv $cv): self
    {
        $this->cv = $cv;

        return $this;
    }
}
