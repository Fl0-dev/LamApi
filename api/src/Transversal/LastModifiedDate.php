<?php

namespace App\Transversal;

use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait for using LastModifiedDate
 */
trait LastModifiedDate
{
    /**
     * Date when was last modified
     *
     */
    #[ORM\Column(type: "datetime")]
    private ?\DateTime $lastModifiedDate = null;

    /**
     * Get Last Modified Date
     */
    public function getLastModifiedDate(): ?\DateTime
    {
        return $this->lastModifiedDate;
    }

    /**
     * Set Last Modified Date
     */
    public function setLastModifiedDate(\DateTime|string|null $lastModifiedDate): self
    {
        if (is_string($lastModifiedDate)) {
            $lastModifiedDate = Utils::createDateTimeFromString($lastModifiedDate);
        }

        $this->lastModifiedDate = $lastModifiedDate;

        return $this;
    }

    /**
     * Check if has a valid Last Modified Date
     */
    public function hasLastModifiedDate(): bool
    {
        return $this->getLastModifiedDate() instanceof \DateTime;
    }
}
