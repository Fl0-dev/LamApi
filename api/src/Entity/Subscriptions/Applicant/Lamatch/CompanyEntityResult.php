<?php

namespace App\Entity\Subscriptions\Applicant\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetApplicantLamatchResults;
use App\Entity\Company\CompanyEntity;
use App\Repository\SubscriptionRepositories\Applicant\CompanyEntityResultRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyEntityResultRepository::class)]
#[ApiResource(operations: [
    new GetCollection(
        security: "is_granted('ROLE_APPLICANT')",
        uriTemplate: '/applicant/lamatch/results',
        controller: GetApplicantLamatchResults::class,
        uriVariables: [],
        openapiContext: [
            'summary' => 'Start a matching',
            'tags' => ['Lamatch'],
        ]
    )
])]
class CompanyEntityResult
{
    use Uuid;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyEntity $companyEntity = null;

    #[ORM\ManyToOne(inversedBy: 'companyEntityResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantLamatch $applicantLamatch = null;

    #[ORM\Column]
    private ?int $matchingPercentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

        return $this;
    }

    public function getApplicantLamatch(): ?ApplicantLamatch
    {
        return $this->applicantLamatch;
    }

    public function setApplicantLamatch(?ApplicantLamatch $applicantLamatch): self
    {
        $this->applicantLamatch = $applicantLamatch;

        return $this;
    }

    public function getMatchingPercentage(): ?int
    {
        return $this->matchingPercentage;
    }

    public function setMatchingPercentage(int $matchingPercentage): self
    {
        $this->matchingPercentage = $matchingPercentage;

        return $this;
    }
}
