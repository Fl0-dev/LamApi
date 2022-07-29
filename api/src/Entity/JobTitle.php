<?php

namespace App\Entity;

use App\Repository\JobTitleRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobTitleRepository::class)]
class JobTitle
{
    use Uuid;
    use Slug;
    use Label;
}
