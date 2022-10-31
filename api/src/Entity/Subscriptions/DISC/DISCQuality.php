<?php

namespace App\Entity\Subscriptions\DISC;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\DISC\DISCQualityRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DISCQualityRepository::class)]
#[ApiResource]
class DISCQuality
{
    use Uuid;
    use Label;
    use Slug;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DISCPersonality $personality = null;

    public function getPersonality(): ?DISCPersonality
    {
        return $this->personality;
    }

    public function setPersonality(?DISCPersonality $personality): self
    {
        $this->personality = $personality;

        return $this;
    }
}
