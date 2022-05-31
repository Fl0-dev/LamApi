<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity]
class JobTitle
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity:JobType::class)]
    private $jobTypes;

    /**
     * Constructor
     */
    public function __construct(?string $slug = null)
    {
        $this->setSlug($slug);
    }

    public function __toString()
    {
        return $this->getSlug();
    }

    /**
     * Check if is valid JobTitle
     */
    public function isValidJobTitle(): bool
    {
        return $this->hasSlug();
    }


    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}