<?php

namespace App\Entity;

use App\Repository\CompanySubscriptionRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanySubscriptionRepository::class)]
class CompanySubscription
{
    use Uuid;
    use Slug;
    use Label;
}
