<?php

namespace App\Entity\Location;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\LocationRepositories\CountryRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource]
#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    use Uuid;
    use Slug;
    #[ORM\Column(type: 'string', length: 75)]
    private $name;
    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Region::class, orphanRemoval: true)]
    private $regions;
    public function __construct()
    {
        $this->regions = new ArrayCollection();
    }
    public function getName() : ?string
    {
        return $this->name;
    }
    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return Collection<int, Region>
     */
    public function getRegions() : Collection
    {
        return $this->regions;
    }
    public function addRegion(Region $region) : self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
            $region->setCountry($this);
        }
        return $this;
    }
    public function removeRegion(Region $region) : self
    {
        if ($this->regions->removeElement($region)) {
            // set the owning side to null (unless already changed)
            if ($region->getCountry() === $this) {
                $region->setCountry(null);
            }
        }
        return $this;
    }
}
