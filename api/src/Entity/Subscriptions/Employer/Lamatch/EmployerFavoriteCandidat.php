<?php

namespace App\Entity\Subscriptions\Employer\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\PostEmployerFavoriteApplicantResult;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\EmployerFavoriteCandidatRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmployerFavoriteCandidatRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            security: "is_granted('ROLE_EMPLOYER')",
            controller: PostEmployerFavoriteApplicantResult::class,
            uriTemplate: '/employer/favorite/candidats',
            uriVariables: [],
            denormalizationContext: ['groups' => [self::OPERATION_NAME_POST_EMPLOYER_FAVORITE_APPLICANT_RESULT]],
            openapiContext: [
                'summary' => 'Add a applicantResult to the employer favorite candidats',
                'description' => 'Add a applicantResult to the employer favorite candidats',
            ]
        ),
    ]
)]
class EmployerFavoriteCandidat
{
    use Uuid;

    public const OPERATION_NAME_POST_EMPLOYER_FAVORITE_APPLICANT_RESULT = 'post_employer_favorite_applicant_result';

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::OPERATION_NAME_POST_EMPLOYER_FAVORITE_APPLICANT_RESULT])]
    private ?ApplicantResult $applicantResult = null;

    #[ORM\ManyToOne(inversedBy: 'employerFavoriteCandidats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employer $employer = null;

    public function getApplicantResult(): ?ApplicantResult
    {
        return $this->applicantResult;
    }

    public function setApplicantResult(ApplicantResult $applicantResult): self
    {
        $this->applicantResult = $applicantResult;

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
}
