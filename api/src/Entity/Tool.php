<?php

namespace App\Entity;

use App\Repository\ToolRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolRepository::class)]
class Tool
{
    use Uuid;
    use Slug;
    use Label;
}
