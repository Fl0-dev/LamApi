<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Employer")]
#[ApiResource()]
class Employer extends UserPhysical
{
    
}
