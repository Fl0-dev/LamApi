<?php

namespace App\Entity\Media;

use App\Repository\MediaRepositories\MediaVideoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaVideoRepository::class)]
class MediaVideo extends Media
{
    #[ORM\Column(type: 'boolean')]
    private bool $autoplay = false;

    public function isAutoplay()
    {
        return true === $this->autoplay;
    }

    public function setAutoplay($autoplay)
    {
        if (is_bool($autoplay)) {
            $this->autoplay = $autoplay;
        }

        return $this;
    }

}
