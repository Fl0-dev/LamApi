<?php

namespace App\Entity;

use App\Repository\CompanyGroupHasSubscriptionRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyGroupHasSubscriptionRepository::class)]
class CompanyGroupHasSubscription
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\ManyToOne(targetEntity: CompanyGroup::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $companyGroup;

    #[ORM\ManyToOne(targetEntity: CompanySubscription::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $companySubscription;

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }

    public function getCompanySubscription(): ?CompanySubscription
    {
        return $this->companySubscription;
    }

    public function setCompanySubscription(?CompanySubscription $companySubscription): self
    {
        $this->companySubscription = $companySubscription;

        return $this;
    }
}
