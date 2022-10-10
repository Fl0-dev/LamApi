<?php

namespace App\Entity\Location;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use App\Controller\DepartmentController;
use App\Entity\JobBoard;
use App\Repository\LocationRepositories\DepartmentRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(operations: [new Get(), new Get(uriTemplate: '/departments-count', controller: DepartmentController::class, paginationEnabled: false, read: false, filters: [], openapiContext: ['summary' => 'Count all departments', 'description' => 'Count all departments. #withoutIdentifier', 'responses' => [['description' => 'Count all company groups', 'content' => ['application/json' => ['schema' => ['type' => 'integer', 'example' => 91]]]]]]), new Post(), new GetCollection()])]
#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    const OPERATION_NAME_COUNT_ALL_DEPARTMENTS_WITH_COMPANY = 'countAllDepartmentsWithCompany';
    use Uuid;
    use Slug;
    #[ORM\Column(type: 'string', length: 75)]
    #[Groups([City::OPERATION_NAME_GET_ALL_CITIES])]
    private $name;
    #[ORM\Column(type: 'string', length: 7)]
    private $code;
    #[ORM\ManyToOne(targetEntity: Region::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $region;
    #[ORM\OneToMany(mappedBy: 'department', targetEntity: City::class)]
    private $cities;
    public function __construct()
    {
        $this->cities = new ArrayCollection();
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
    public function getCode() : ?string
    {
        return $this->code;
    }
    public function setCode(string $code) : self
    {
        $this->code = $code;
        return $this;
    }
    public function getRegion() : ?Region
    {
        return $this->region;
    }
    public function setRegion(?Region $region) : self
    {
        $this->region = $region;
        return $this;
    }
    /**
     * @return Collection<int, City>
     */
    public function getCities() : Collection
    {
        return $this->cities;
    }
    public function addCity(City $city) : self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setDepartment($this);
        }
        return $this;
    }
    public function removeCity(City $city) : self
    {
        if ($this->cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getDepartment() === $this) {
                $city->setDepartment(null);
            }
        }
        return $this;
    }
}
