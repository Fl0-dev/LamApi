<?php

namespace App\Entity;

use App\Repository\ApplicantCvRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Label;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantCvRepository::class)]
class ApplicantCv
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;
    use Label;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\ManyToOne(targetEntity: Applicant::class, inversedBy: 'applicantCvs')]
    private $applicant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
