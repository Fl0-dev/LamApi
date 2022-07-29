<?php

namespace App\Entity;

use App\Repository\JobTypeRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobTypeRepository::class)]
class JobType
{
    use Uuid;
    use Slug;
    use Label;
}
