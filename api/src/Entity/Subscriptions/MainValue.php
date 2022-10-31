<?php

namespace App\Entity\Subscriptions;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\MainValueRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainValueRepository::class)]
#[ApiResource]
class MainValue
{
    use Uuid;
    use Label;
    use Slug;
}
