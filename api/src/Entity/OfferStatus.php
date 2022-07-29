<?php

namespace App\Entity;

use App\Repository\OfferStatusRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferStatusRepository::class)]
class OfferStatus
{
    use Uuid;
    use Slug;
    use Label;
}
