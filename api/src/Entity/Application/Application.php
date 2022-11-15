<?php

namespace App\Entity\Application;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
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
        new Get(),
        new Put(),
        new Patch(),
        new Delete(),
        new Post(
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

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        self::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    private $motivationText;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
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
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
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

    #[ORM\OneToMany(mappedBy: 'application', targetEntity: ApplicantionExchange::class)]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    private $applicantionExchanges;

    #[ORM\Column]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'applications', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    private ?CompanyEntityOffice $companyEntityOffice = null;

    #[ORM\Column]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    private ?bool $activeSending = null;

    public function __construct()
    {
        $this->applicantionExchanges = new ArrayCollection();
        $this->activeSending = true;
    }

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
    ])]
    public function getCreatedDate(): ?\DateTime
    {
        return $this->createdDate;
    }

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        self::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID,
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID
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
     * @return Collection<int, ApplicantionExchange>
     */
    public function getApplicantionExchanges(): Collection
    {
        return $this->applicantionExchanges;
    }

    public function addApplicantionExchange(ApplicantionExchange $applicantionExchange): self
    {
        if (!$this->applicantionExchanges->contains($applicantionExchange)) {
            $this->applicantionExchanges[] = $applicantionExchange;
            $applicantionExchange->setApplication($this);
        }

        return $this;
    }

    public function removeApplicantionExchange(ApplicantionExchange $applicantionExchange): self
    {
        if ($this->applicantionExchanges->removeElement($applicantionExchange)) {
            // set the owning side to null (unless already changed)
            if ($applicantionExchange->getApplication() === $this) {
                $applicantionExchange->setApplication(null);
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
