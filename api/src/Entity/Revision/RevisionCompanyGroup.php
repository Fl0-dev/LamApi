<?php

namespace App\Entity\Revision;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\CompanyGroup;
use App\Repository\Revision\RevisionCompanyGroupRepository;
use App\Transversal\CreatedDate;
use App\Transversal\FieldContent;
use App\Transversal\FieldName;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RevisionCompanyGroupRepository::class)]
#[ApiResource]
class RevisionCompanyGroup
{
    use Uuid;
    use CreatedDate;
    use FieldName;
    use FieldContent;

    #[ORM\ManyToOne(inversedBy: 'revisionCompanyGroups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompanyGroup $companyGroup = null;

    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }
}
