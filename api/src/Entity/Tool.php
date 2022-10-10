<?php

namespace App\Entity;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
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
#[ApiResource]
#[ORM\Entity(repositoryClass: ToolRepository::class)]
#[ApiFilter(filterClass: SearchFilter::class, properties: ['slug' => 'ipartial'])]
class Tool
{
    use Uuid;
    use Slug;
    use Label;
    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, Offer::OPERATION_NAME_GET_OFFER_DETAILS])]
    private ?Media $logo = null;
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, Offer::OPERATION_NAME_GET_OFFER_DETAILS])]
    public function getId() : ?BaseUuid
    {
        return $this->id;
    }
    public function getLogo() : ?Media
    {
        return $this->logo;
    }
    public function setLogo(?Media $logo) : self
    {
        $this->logo = $logo;
        return $this;
    }
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, Offer::OPERATION_NAME_GET_OFFER_DETAILS, JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS, Offer::OPERATION_NAME_GET_ALL_OFFERS])]
    public function getTool() : array
    {
        $logoPath = $this->getLogo()->getFilePath();
        $arrayToolInfos = ['id' => $this->getId(), 'label' => $this->getLabel(), 'url' => Constants::HOST_URL . "/{$logoPath}"];
        return $arrayToolInfos;
    }
}
