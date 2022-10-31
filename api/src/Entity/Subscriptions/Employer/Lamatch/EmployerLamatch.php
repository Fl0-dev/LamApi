<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployerLamatchRepository::class)]
#[ApiResource]
class EmployerLamatch
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatchProfile $EmployerLamatchProfile = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatchSubscription $employerLamatchSubscription = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEmployerLamatchProfile(): ?EmployerLamatchProfile
    {
        return $this->EmployerLamatchProfile;
    }

    public function setEmployerLamatchProfile(EmployerLamatchProfile $EmployerLamatchProfile): self
    {
        $this->EmployerLamatchProfile = $EmployerLamatchProfile;

        return $this;
    }

    public function getEmployerLamatchSubscription(): ?EmployerLamatchSubscription
    {
        return $this->employerLamatchSubscription;
    }

    public function setEmployerLamatchSubscription(EmployerLamatchSubscription $employerLamatchSubscription): self
    {
        $this->employerLamatchSubscription = $employerLamatchSubscription;

        return $this;
    }
}
