<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: 'text', nullable: true)]
    private $motivation;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score;

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
