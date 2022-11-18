<?php

namespace App\Entity\Application;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetApplicationsByCurrentApplicant;
use App\Controller\PostApplicationByOfferId;
use App\Controller\PostSpontaneousApplication;
use App\Entity\Applicant\Applicant;
use App\Entity\Applicant\ApplicantCv;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyGroup;
use App\Entity\Offer\Offer;
use App\Repository\ApplicationRepositories\ApplicationRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[
    ApiResource(operations: [
        new GetCollection(
            uriTemplate: '/applications',
            controller: GetApplicationsByCurrentApplicant::class,
            normalizationContext: ['groups' => [self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT]],
            openapiContext: [
                'summary' => 'Get applications by current applicant',
                'description' => 'Get applications by current applicant',
                'tags' => ['Application'],
            ],
        ),
        new GetCollection(
            security: "is_granted('ROLE_USER')",
            uriTemplate: '/applications/{id}/exchanges',
            normalizationContext: ['groups' => [self::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID]],
            order: ['applicationExchanges.createdDate' => 'ASC'],
        ),
        new Get(
            security: "is_granted('ROLE_USER')",
        ),
        new Patch(
            security: "is_granted('ROLE_APPLICANT')",
        ),
        new Delete(
            security: "is_granted('ROLE_APPLICANT')",
        ),
        new Post(
            security: "is_granted('ROLE_APPLICANT')",
            uriTemplate: '/applications/{offerId}',
            controller: PostApplicationByOfferId::class,
            deserialize: false,
            uriVariables: [],
            denormalizationContext: [
                'groups' => [self::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID]
            ],
            openapiContext: [
                'summary' => 'Post application for an offer by offer id',
                'description' => 'Post application for an offer by offer id',
                'parameters' => [
                    [
                        'name' => 'offerId',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string'
                        ]
                    ]
                ],
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ],
                                    'motivationText' => [
                                        'type' => 'string'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ),
        new Post(
            security: "is_granted('ROLE_APPLICANT')",
            uriTemplate: '/applications/spontaneous/{companyEntityOfficeId}',
            uriVariables: [],
            controller: PostSpontaneousApplication::class,
            deserialize: false,
            normalizationContext: [
                'groups' => [
                    self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID
                ]
            ],
            openapiContext: [
                'summary' => 'Post spontaneous application for a company entity by company entity id',
                'description' => 'Post spontaneous application for a company entity by company entity id',
                'parameters' => [
                    [
                        'name' => 'companyEntityOfficeId',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string'
                        ]
                    ]
                ],
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ],
                                    'motivationText' => [
                                        'type' => 'string'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        )
    ])
]
#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    use Uuid;
    use LastModifiedDate;
    use CreatedDate;

    public const OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID = 'postApplicationByOfferId';
    public const OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID =
    'postSpontaneaousApplicationByCompanyEntityOfficeId';
    public const OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID =
    'getApplicationExchangesByApplicationId';
    public const OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT = 'getApplicationsByCurrentApplicant';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    private $motivationText;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    private $score;

    #[ORM\ManyToOne(targetEntity: Applicant::class, inversedBy: 'applications', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID
    ])]
    private $applicant;

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'applications', cascade: ['persist'])]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    private $offer;

    #[ORM\ManyToOne(targetEntity: ApplicantCv::class, cascade: ['persist'])]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        self::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID
    ])]
    private $cv;

    #[ORM\OneToMany(mappedBy: 'application', targetEntity: ApplicationExchange::class)]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT,
        self::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID
    ])]
    private $applicationExchanges;

    #[ORM\Column]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'applications', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    private ?CompanyEntityOffice $companyEntityOffice = null;

    #[ORM\Column]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    private ?bool $activeSending = null;

    public function __construct()
    {
        $this->applicationExchanges = new ArrayCollection();
        $this->activeSending = false;
    }

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT,
    ])]
    public function getCreatedDate(): ?\DateTime
    {
        return $this->createdDate;
    }

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        self::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT,
    ])]
    public function getLastModifiedDate(): ?\DateTime
    {
        return $this->lastModifiedDate;
    }

    public function getMotivationText(): ?string
    {
        return $this->motivationText;
    }

    public function setMotivationText(?string $motivationText): self
    {
        $this->motivationText = $motivationText;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

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

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getCv(): ?ApplicantCv
    {
        return $this->cv;
    }

    public function setCv(?ApplicantCv $cv): self
    {
        $this->cv = $cv;
        return $this;
    }

    /**
     * @return Collection<int, ApplicationExchange>
     */
    public function getApplicationExchanges(): Collection
    {
        return $this->applicationExchanges;
    }

    public function addApplicationExchange(ApplicationExchange $applicationExchange): self
    {
        if (!$this->applicationExchanges->contains($applicationExchange)) {
            $this->applicationExchanges[] = $applicationExchange;
            $applicationExchange->setApplication($this);
        }

        return $this;
    }

    public function removeApplicationExchange(ApplicationExchange $applicationExchange): self
    {
        if ($this->applicationExchanges->removeElement($applicationExchange)) {
            // set the owning side to null (unless already changed)
            if ($applicationExchange->getApplication() === $this) {
                $applicationExchange->setApplication(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCompanyEntityOffice(): ?CompanyEntityOffice
    {
        return $this->companyEntityOffice;
    }

    public function setCompanyEntityOffice(?CompanyEntityOffice $companyEntityOffice): self
    {
        $this->companyEntityOffice = $companyEntityOffice;

        return $this;
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
}
