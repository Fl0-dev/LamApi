<?php

namespace App\Entity\Revision;

use ApiPlatform\Metadata\ApiResource;
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

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

        return $this;
    }
}
