<?php

namespace App\Entity;


use ApiPlatform\Metadata\ApiResource;
use App\Entity\Company\CompanyGroup;
use App\Entity\Media\MediaImage;
use App\Repository\OrganisationRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource]
#[ORM\Entity(repositoryClass: OrganisationRepository::class)]
class Organisation
{
    use Uuid;
    use Slug;
    use CreatedDate;
    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private $name;
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $website;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    private ?MediaImage $logo = null;
    public function getName() : ?string
    {
        return $this->name;
    }
    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }
    public function getWebsite() : ?string
    {
        return $this->website;
    }
    public function setWebsite(?string $website) : self
    {
        $this->website = $website;
        return $this;
    }
    public function getType() : ?string
    {
        return $this->type;
    }
    public function setType(?string $type) : self
    {
        $this->type = $type;
        return $this;
    }
    public function getLogo() : ?MediaImage
    {
        return $this->logo;
    }
    public function setLogo(?MediaImage $logo) : self
    {
        $this->logo = $logo;
        return $this;
    }
}
