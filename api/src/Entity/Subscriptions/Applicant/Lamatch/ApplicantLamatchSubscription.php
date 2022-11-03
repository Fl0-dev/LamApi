<?php

namespace App\Entity\Subscriptions\Applicant\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantLamatchSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantLamatchSubscriptionRepository::class)]
#[ApiResource]
class ApplicantLamatchSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantLamatchProfile $applicantLamatchProfile = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getApplicantLamatchProfile(): ?ApplicantLamatchProfile
    {
        return $this->applicantLamatchProfile;
    }

    public function setApplicantLamatchProfile(ApplicantLamatchProfile $applicantLamatchProfile): self
    {
        $this->applicantLamatchProfile = $applicantLamatchProfile;

        return $this;
    }
}
