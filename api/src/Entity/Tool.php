<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ToolRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolRepository::class)]
#[ApiResource()]
#[ApiFilter(SearchFilter::class, properties: ['slug' => 'ipartial'])]
class Tool
{
    use Uuid;
    use Slug;
    use Label;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
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
