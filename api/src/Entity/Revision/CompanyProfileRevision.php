<?php

namespace App\Entity\Revision;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use App\Entity\Company\CompanyProfile;
use App\Repository\RevisionRepositories\CompanyProfileRevisionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\FieldContent;
use App\Transversal\FieldName;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource]
#[ORM\Entity(repositoryClass: CompanyProfileRevisionRepository::class)]
class CompanyProfileRevision
{
    use Uuid;
    use CreatedDate;
    use FieldName;
    use FieldContent;
    #[ORM\ManyToOne(inversedBy: 'companyProfileRevisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyProfile $CompanyProfile = null;
    public function getCompanyProfile() : ?CompanyProfile
    {
        return $this->CompanyProfile;
    }
    public function setCompanyProfile(?CompanyProfile $CompanyProfile) : self
    {
        $this->CompanyProfile = $CompanyProfile;
        return $this;
    }
}
