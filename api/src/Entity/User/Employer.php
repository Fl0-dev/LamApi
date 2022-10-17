<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
#[ORM\Table(name: "employer")]
class Employer extends UserPhysical
{
    public function getPhysicalType(): string
    {
        return self::TYPE_EMPLOYER;
    }
}
