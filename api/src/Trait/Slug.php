<?php

namespace App\Trait;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait for using Slug
 */
trait Slug
{
    /**
     * Slug
     *
     * @ORM\Column(type="string")
     */
    private ?string $slug = null;

    /**
     * Get Slug value
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set Slug value
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Check if has a valid Slug
     */
    public function hasSlug(): bool
    {
        $slug = $this->getSlug();

        return is_string($slug) && strlen($slug) > 0;
    }
}
