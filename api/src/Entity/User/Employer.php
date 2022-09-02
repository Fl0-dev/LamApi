<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "employer")]
#[ApiResource()]
class Employer extends UserPhysical
{
    
}
