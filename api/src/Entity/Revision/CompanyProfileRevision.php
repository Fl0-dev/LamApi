<?php

namespace App\Entity\Revision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\CompanyProfile;
use App\Repository\RevisionRepositories\CompanyProfileRevisionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\FieldContent;
use App\Transversal\FieldName;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyProfileRevisionRepository::class)]
#[ApiResource]
class CompanyProfileRevision
{
    use Uuid;
    use CreatedDate;
    use FieldName;
    use FieldContent;

    #[ORM\ManyToOne(inversedBy: 'companyProfileRevisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyProfile $CompanyProfile = null;

    public function getCompanyProfile(): ?CompanyProfile
    {
        return $this->CompanyProfile;
    }

    public function setCompanyProfile(?CompanyProfile $CompanyProfile): self
    {
        $this->CompanyProfile = $CompanyProfile;

        return $this;
    }
}
