<?php

namespace App\Entity\Applicant;

use App\Repository\ApplicantRepositories\ApplicantStatusHistoryRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantStatusHistoryRepository::class)]
class ApplicantStatusHistory
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(type: 'string', length: 11)]
    private $status;

    #[ORM\ManyToOne(targetEntity: Applicant::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $applicant;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(?Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }
}
