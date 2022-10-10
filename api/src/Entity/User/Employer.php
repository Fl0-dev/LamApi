<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource]
#[ORM\Entity]
#[ORM\Table(name: "employer")]
class Employer extends UserPhysical
{
    public function getType() : string
    {
        return self::TYPE_EMPLOYER;
    }
}
