<?php

namespace App\Entity;

use App\Repository\JobResearchRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobResearchRepository::class)]
class JobResearch
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;
}
