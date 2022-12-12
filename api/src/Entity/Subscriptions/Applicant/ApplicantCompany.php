<?php

namespace App\Entity\Subscriptions\Applicant;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\DeleteApplicantFavoriteCompanyEntity;
use App\Controller\GetFavoriteCompanyByCurrentApplicant;
use App\Controller\PatchApplicantFavoriteCompanyEntity;
use App\Controller\PostApplicantFavoriteCompanyEntity;
use App\Entity\Company\CompanyEntity;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantCompanyRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ApplicantCompanyRepository::class)]
#[ApiResource(operations: [
    new Post(
        security: "is_granted('ROLE_APPLICANT')",
        uriTemplate: '/applicant/favorite_company',
        controller: PostApplicantFavoriteCompanyEntity::class,
        uriVariables: [],
        denormalizationContext: ['groups' => [self::OPERATION_NAME_POST_APPLICANT_FAVORITE_COMPANY_ENTITY]],
        openapiContext: [
            'tags' => ['ApplicantCompanySubscription'],
            'summary' => 'Add a company to the applicant favorite companies',
            'description' => 'Add a company to the applicant favorite companies',
        ],
    ),
    new Get(
        security: "is_granted('ROLE_APPLICANT')",
        controller: GetFavoriteCompanyByCurrentApplicant::class,
    ),
    new Delete(
        security: "is_granted('ROLE_APPLICANT')",
        controller: DeleteApplicantFavoriteCompanyEntity::class,
    ),
    new Patch(
        security: "is_granted('ROLE_APPLICANT')",
        controller: PatchApplicantFavoriteCompanyEntity::class,
        denormalizationContext: ['groups' => [self::OPERATION_NAME_PATCH_APPLICANT_FAVORITE_COMPANY_ENTITY]],
    ),
])]
class ApplicantCompany
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    public const OPERATION_NAME_POST_APPLICANT_FAVORITE_COMPANY_ENTITY = 'post_applicant_favorite_company_entity';
    public const OPERATION_NAME_PATCH_APPLICANT_FAVORITE_COMPANY_ENTITY = 'patch_applicant_favorite_company_entity';

    #[ORM\Column]
    #[Groups([self::OPERATION_NAME_PATCH_APPLICANT_FAVORITE_COMPANY_ENTITY])]
    private ?bool $activeSending = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::OPERATION_NAME_POST_APPLICANT_FAVORITE_COMPANY_ENTITY])]
    private ?CompanyEntity $companyEntity = null;

    #[ORM\ManyToOne(inversedBy: 'applicantCompanies', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ApplicantCompanySubscription $applicantCompanySubscription = null;

    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->lastModifiedDate = new \DateTime();
        $this->setActiveSending(false);
    }

    public function isActiveSending(): ?bool
    {
        return $this->activeSending;
    }

    public function setActiveSending(bool $activeSending): self
    {
        $this->activeSending = $activeSending;

        return $this;
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

    public function getApplicantCompanySubscription(): ?ApplicantCompanySubscription
    {
        return $this->applicantCompanySubscription;
    }

    public function setApplicantCompanySubscription(?ApplicantCompanySubscription $applicantCompanySubscription): self
    {
        $this->applicantCompanySubscription = $applicantCompanySubscription;

        return $this;
    }
}
