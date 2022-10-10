<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "employer")]
#[ApiResource()]
class Employer extends UserPhysical
{
    public function getType(): string
    {
        return self::TYPE_EMPLOYER;
    }
}
