<?php

namespace App\Entity\Media;

use App\Entity\Media\Media;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Video extends Media
{
    /**
     * Media autoplay video
     *
     * @var bool
     */
    private $autoplay;

    /**
     * Media Constructor
     *
     * @param string $src
     * @param string $type
     * @param boolean $autoplay
     * @param boolean $zoomable
     */
    public function __construct($src, $autoplay = false)
    {
        $this->setFilePath($src);
        $this->setAutoplay($autoplay);
        // $this->setTypeVideo();
    }

    /**
     * Check if this Media is an autoplay video
     *
     * @return bool
     */
    public function isAutoplay()
    {
        return true === $this->autoplay;
    }

    /**
     * Set the value of autoplay
     *
     * @param bool $autoplay Media autoplay
     *
     * @return self
     */
    public function setAutoplay($autoplay)
    {
        if (is_bool($autoplay)) {
            $this->autoplay = $autoplay;
        }

        return $this;
    }
}
