<?php

namespace App\Entity\Location;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\LocalisationAction;
use App\Entity\Company\CompanyGroup;
use App\Entity\JobBoard;
use App\Entity\Offer\Offer;
use App\Repository\LocationRepositories\AddressRepository;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(operations: [
    new Get(),
    new GetCollection(
        uriTemplate: '/localisations',
        uriVariables: [],
        controller: LocalisationAction::class,
        openapiContext: [
            'tags' => ['Localisation'],
            'summary' => 'Get all localisations with keywords',
            'parameters' => [
                [
                    'name' => 'keywords',
                    'in' => 'query',
                    'description' => 'Keywords to search',
                    'required' => true,
                    'schema' => [
                        'type' => 'string'
                    ]
                ]
            ]
        ],
    )
])]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    use Uuid;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
        ])]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
        ])]
    private $street;

    #[ORM\Column(type: 'string', length: 10)]
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
        ])]
    private $postalCode;

    #[ORM\Column(type: 'float')]
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
        ])]
    private $latitude;

    #[ORM\Column(type: 'float')]
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS])]
    private $longitude;

    #[ORM\ManyToOne(targetEntity: City::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        Offer::OPERATION_NAME_GET_OFFER_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID
        ])]
    private $city;

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet() : ?string
    {
        return $this->street;
    }

    public function setStreet(string $street) : self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode() : ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode) : self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getLatitude() : ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude) : self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude() : ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude) : self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getCityObject() : ?City
    {
        return $this->city;
    }

    public function setCity(?City $city) : self
    {
        $this->city = $city;

        return $this;
    }

    #[Groups([
        Offer::OPERATION_NAME_GET_ALL_OFFERS, 
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
        ])]
    public function getCityInfos() : ?array
    {
        $arrayCityInfos = [
            'id' => $this->city->getId(), 
            'name' => $this->city->getName(), 
            'fullName' => $this->city->getCityNameAndDepartmentCode(), 
            'department' => $this->city->getDepartment()->getName(), 
            'region' => $this->city->getDepartment()->getRegion()->getName()
        ];
        
        return $arrayCityInfos;
    }
}
