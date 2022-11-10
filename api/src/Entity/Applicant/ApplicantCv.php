<?php

namespace App\Entity\Applicant;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\PostApplicantCv;
use App\Entity\Application\Application;
use App\Entity\Company\CompanyGroup;
use App\Entity\Offer\Offer;
use App\Repository\ApplicantRepositories\ApplicantCvRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
    new Post(
        controller: PostApplicantCv::class,
        openapiContext: [
            'requestBody' => [
                'content' => [
                    'multipart/form-data' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'cv' => [
                                    'type' => 'string',
                                    'format' => 'binary'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    )
])]
#[ORM\Entity(repositoryClass: ApplicantCvRepository::class)]
class ApplicantCv
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        Offer::OPERATION_NAME_GET_APPLICATIONS_BY_OFFER_ID,
        CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID,
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        Application::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID
    ])]
    private $filePath;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups([
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        Application::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID
    ])]
    public ?string $contentUrl = null;

    #[Vich\UploadableField(mapping: "cv_object", fileNameProperty: "filePath")]
    private ?File $file = null;

    #[ORM\ManyToOne(targetEntity: Applicant::class, inversedBy: 'applicantCvs')]
    #[Groups([
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        Application::OPERATION_NAME_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID
    ])]
    private $applicant;

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

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

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl($contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }
}
