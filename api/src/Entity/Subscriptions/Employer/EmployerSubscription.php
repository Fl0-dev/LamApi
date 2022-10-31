<?php

namespace App\Entity\Subscriptions\Employer;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchSubscription;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\EmployerSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerSubscriptionRepository::class)]
#[ApiResource]
class EmployerSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employer $employer = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EmployerLamatchSubscription $lamatchSubscription = null;

    public function getEmployer(): ?Employer
    {
        return $this->employer;
    }

    public function setEmployer(Employer $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    public function getLamatchSubscription(): ?EmployerLamatchSubscription
    {
        return $this->lamatchSubscription;
    }

    public function setLamatchSubscription(?EmployerLamatchSubscription $lamatchSubscription): self
    {
        $this->lamatchSubscription = $lamatchSubscription;

        return $this;
    }
}
