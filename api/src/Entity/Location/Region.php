<?php

namespace App\Entity\Location;

use ApiPlatform\Metadata\ApiResource;

use App\Repository\LocationRepositories\RegionRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource]
#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 75)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'regions')]
    #[ORM\JoinColumn(nullable: false)]
    private $country;

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry() : ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country) : self
    {
        $this->country = $country;
        
        return $this;
    }
}
