<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetEmployerLamatchResultsByProfileId;
use App\Entity\Applicant\Applicant;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Repository\SubscriptionRepositories\Employer\ApplicantResultRepository;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantResultRepository::class)]
#[ApiResource(operations: [
    new GetCollection(
        security: "is_granted('ROLE_EMPLOYER')",
        uriTemplate: '/employer/lamatch/results/{profileId}',
        controller: GetEmployerLamatchResultsByProfileId::class,
        uriVariables: [],
        openapiContext: [
            'summary' => 'Start a matching',
            'tags' => ['Lamatch'],
            'description' => 'Start a matching',
            'parameters' => [
                [
                    'name' => 'profileId',
                    'in' => 'path',
                    'required' => true,
                    'description' => 'The profile id',
                    'schema' => [
                        'type' => 'string',
                        'format' => 'uuid',
                    ],
                ],
            ],
        ]
    )
])]
class ApplicantResult
{
    use Uuid;

    #[ORM\Column]
    private ?int $matchingPercentage = null;

    #[ORM\ManyToOne]
    private ?Applicant $applicant = null;

    #[ORM\ManyToOne]
    private ?ApplicantLamatchProfile $applicantLamatchProfile = null;

    #[ORM\ManyToOne(inversedBy: 'applicantResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployerLamatch $employerLamatch = null;

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

    public function getApplicantLamatchProfile(): ?ApplicantLamatchProfile
    {
        return $this->applicantLamatchProfile;
    }

    public function setApplicantLamatchProfile(?ApplicantLamatchProfile $applicantLamatchProfile): self
    {
        $this->applicantLamatchProfile = $applicantLamatchProfile;

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
}
