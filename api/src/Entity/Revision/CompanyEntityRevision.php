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
use App\Entity\Company\CompanyEntity;
use App\Repository\RevisionRepositories\CompanyEntityRevisionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\FieldContent;
use App\Transversal\FieldName;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource]
#[ORM\Entity(repositoryClass: CompanyEntityRevisionRepository::class)]
class CompanyEntityRevision
{
    use Uuid;
    use CreatedDate;
    use FieldName;
    use FieldContent;
    #[ORM\ManyToOne(inversedBy: 'companyEntityRevisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyEntity $companyEntity = null;
    public function getCompanyEntity() : ?CompanyEntity
    {
        return $this->companyEntity;
    }
    public function setCompanyEntity(?CompanyEntity $companyEntity) : self
    {
        $this->companyEntity = $companyEntity;
        return $this;
    }
}
