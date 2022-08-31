<?php

namespace App\Entity\Application;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ApplicationController;
use App\Entity\Applicant\Applicant;
use App\Entity\Applicant\ApplicantCv;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Offer\Offer;
use App\Repository\ApplicationRepositories\ApplicationRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
#[ApiResource(
    collectionOperations: [
        self::OPERATION_NAME__POST_APPLICATION_BY_OFFER_ID => [
            'method' => 'POST',
            'path' => '/applications/{offerId}',
            'controller' => ApplicationController::class,
            'deserialize' => false,
            'denormalization_context' => [
                'groups' => ['write:postApplicationByOfferId'],
            ],
            'openapi_context' => [
                'summary' => 'Post application for an offer by offer id',
                'description' => 'Post application for an offer by offer id',
                'parameters' => [
                    [
                        'name' => 'offerId',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                    'motivationText' => [
                                        'type' => 'string',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        self::OPERATION_NAME__PATH_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID => [
            'method' => 'POST',
            'path' => '/applications/spontaneaous/{companyEntityOfficeId}',
            'controller' => ApplicationController::class,
            'deserialize' => false,
            'denormalization_context' => [
                'groups' => ['write:postSpontaneousApplicationByCompanyEntityId'],
            ],
            'openapi_context' => [
                'summary' => 'Post spontaneous application for a company entity by company entity id',
                'description' => 'Post spontaneous application for a company entity by company entity id',
                'parameters' => [
                    [
                        'name' => 'companyEntityOfficeId',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                    'motivationText' => [
                                        'type' => 'string',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]
    ],
)]
class Application
{
    const OPERATION_NAME__POST_APPLICATION_BY_OFFER_ID = 'postApplicationByOfferId';
    const OPERATION_NAME__PATH_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID = 'postSpontaneaousApplicationByCompanyEntityOfficeId';

    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications', 'write:postApplicationByOfferId'])]
    private $motivationText;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $score;

    #[ORM\ManyToOne(targetEntity: Applicant::class, inversedBy: 'applications', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $applicant;

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'applications', cascade: ['persist'])]
    #[Groups(['read:getCompanyGroupApplications'])]
    private $offer;

    #[ORM\ManyToOne(targetEntity: ApplicantCv::class, cascade: ['persist'])]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications', 'write:postApplicationByOfferId'])]
    private $cv;

    #[ORM\OneToMany(mappedBy: 'application', targetEntity: ApplicantionExchange::class)]
    private $applicantionExchanges;

    #[ORM\Column(length: 11)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'applications', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyEntityOffice $companyEntityOffice = null;

    public function __construct()
    {
        $this->applicantionExchanges = new ArrayCollection();
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
}