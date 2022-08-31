<?php

namespace App\Entity\Applicant;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApplicantRepositories\ApplicantCvRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 */
#[ORM\Entity(repositoryClass: ApplicantCvRepository::class)]
#[ApiResource(
)]
class ApplicantCv
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications','write:postApplicationByOfferId'])]
    private $filePath;

    #[ApiProperty(iri: 'https://schema.org/contentUrl')]
    #[Groups(['write:postApplicationByOfferId'])]
    public ?string $contentUrl = null;

    /**
     * @Vich\UploadableField(mapping="cv_object", fileNameProperty="filePath")
     */
    private ?File $file = null;

    #[ORM\ManyToOne(targetEntity: Applicant::class, inversedBy: 'applicantCvs')]
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

    /**
     * Get the value of contentUrl
     */ 
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * Set the value of contentUrl
     *
     * @return  self
     */ 
    public function setContentUrl($contentUrl)
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }
}
