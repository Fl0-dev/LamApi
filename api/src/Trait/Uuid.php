<?php

namespace App\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * Trait for using Uuid
 */
trait UseUuid
{
    /**
     * Uuid Property
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private ?Uuid $id = null;

    /**
     * Get Uuid value
     */
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * Set Uuid value
     */
    public function setId(Uuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Check if Uuid has a valid value
     */
    public function hasId(): bool
    {
        return $this->id instanceof Uuid;
    }
}
