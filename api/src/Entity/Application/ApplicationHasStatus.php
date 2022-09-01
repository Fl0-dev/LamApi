<?php

namespace App\Entity\Application;

use App\Entity\User\Employer;
use App\Repository\ApplicationRepositories\ApplicationHasStatusRepository;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationHasStatusRepository::class)]
class ApplicationHasStatus
{
    use Uuid;
    use LastModifiedDate;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne]
    private ?Employer $employer = null;

    #[ORM\ManyToOne]
    private ?Application $application = null;

    #[ORM\Column(nullable: true)]
    private ?string $status = null;

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
}
