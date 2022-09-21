<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Company\CompanyGroup;
use App\Entity\Media\Media;
use App\Entity\Offer\Offer;
use App\Repository\ToolRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ToolRepository::class)]
#[ApiResource()]
#[ApiFilter(SearchFilter::class, properties: ['slug' => 'ipartial'])]
class Tool
{
    use Uuid;
    use Slug;
    use Label;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_DETAILS
    ])]
    private ?Media $logo = null;

    public function getLogo(): ?Media
    {
        return $this->logo;
    }

    public function setLogo(?Media $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
