<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetDetailEmployerLamatchResultByResultId;
use App\Controller\GetEmployerLamatchResultsByProfileId;
use App\Entity\Applicant\Applicant;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use App\Repository\SubscriptionRepositories\Employer\ApplicantResultRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantResultRepository::class)]
#[ApiResource(operations: [
    new GetCollection(
        security: "is_granted('ROLE_EMPLOYER')",
        uriTemplate: '/employer/lamatch/results',
        controller: GetEmployerLamatchResultsByProfileId::class,
        uriVariables: [],
        openapiContext: [
            'summary' => 'Start a matching',
            'tags' => ['Lamatch'],
            'description' => 'Start a matching',
            'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'profileId' => [
                                        'type' => 'string',
                                        'format' => 'uuid',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ]
        ]
    ),
    new Get(
        security: "is_granted('ROLE_EMPLOYER')",
        uriTemplate: '/employer/lamatch/results/applicant/{id}',
        controller: GetDetailEmployerLamatchResultByResultId::class,
        openapiContext: [
            'summary' => 'Get a detail of a result of a matching',
            'tags' => ['Lamatch'],
            'description' => 'Get a detail of a result of a matching',
        ]
    ),
])]
class ApplicantResult
{
    use Uuid;

    #[ORM\Column]
    private ?int $matchingPercentage = null;

    #[ORM\ManyToOne]
    private ?Applicant $applicant = null;

    #[ORM\ManyToOne(inversedBy: 'applicantResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatch $employerLamatch = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]

    private ?ApplicantLamatchProfile $applicantLamatchProfile = null;

    public function getMatchingPercentage(): ?int
    {
        return $this->matchingPercentage;
    }

    public function setMatchingPercentage(int $matchingPercentage): self
    {
        $this->matchingPercentage = $matchingPercentage;

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

    public function getEmployerLamatch(): ?EmployerLamatch
    {
        return $this->employerLamatch;
    }

    public function setEmployerLamatch(?EmployerLamatch $employerLamatch): self
    {
        $this->employerLamatch = $employerLamatch;

        return $this;
    }

    public function getApplicantLamatchProfile(): ?ApplicantLamatchProfile
    {
        return $this->applicantLamatchProfile;
    }

    public function setApplicantLamatchProfile(?ApplicantLamatchProfile $applicantLamatchProfile): self
    {
        $this->applicantLamatchProfile = $applicantLamatchProfile;

        return $this;
    }
}
