<?php

namespace App\Entity\Location;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\CompanyGroup;
use App\Entity\JobBoard;
use App\Entity\Offer\Offer;
use App\Filter\LocationFilter;
use App\Repository\LocationRepositories\CityRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid as BaseUuid;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CityRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'method' => 'GET',
            'path' => '/cities',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_ALL_CITIES],
            ],
        ],
    ],
)]
#[ApiFilter(LocationFilter::class)]
class City
{
    const OPERATION_NAME_GET_ALL_CITIES = 'getAllCities';

    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 75)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_CITIES, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
    ])]
    private $name;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        self::OPERATION_NAME_GET_ALL_CITIES, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
    ])]
    private $department;

    #[Groups([
        Offer::OPERATION_NAME_GET_ALL_OFFER,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
    ])]
    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        Offer::OPERATION_NAME_GET_OFFER_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
    ])]
    public function getCityNameAndNbDepartment(): string
    {
        return $this->name . ' (' . $this->department->getCode() . ')';
    }
    
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }
}
