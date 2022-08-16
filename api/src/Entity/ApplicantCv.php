<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApplicantCvRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Label;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ApplicantCvRepository::class)]
#[ApiResource()]
class ApplicantCv
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;
    use Label;
    
    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:getOfferApplications', 'read:getCompanyGroupApplications'])]
    private $filePath;

    /**
     * @var File|null
     *
     */
    #[Assert\NotNull()]
    #[Vich\UploadableField(mapping: "cv_object", fileNameProperty: "filePath")]
    private ?File $file;

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
}
