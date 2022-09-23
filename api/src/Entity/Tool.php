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
use App\Utils\Constants;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid as BaseUuid;
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
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
    ])]
    private ?Media $logo = null;

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
    ])]
    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    public function getLogo(): ?Media
    {
        return $this->logo;
    }

    public function setLogo(?Media $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
        Offer::OPERATION_NAME_GET_ALL_OFFERS,
    ])]
    public function getTool(): array
    {
        $logoPath= $this->getLogo()->getFilePath();
        $arrayToolInfos = [
            'id' => $this->getId(),
            'label' => $this->getLabel(),
            'url' =>Constants::HOST_URL .'/'. $logoPath,
        ];

        return $arrayToolInfos;
    }
}
