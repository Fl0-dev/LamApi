<?php

namespace App\Functional;

use App\Utils\Utils;

/**
 * Trait for Default Entity Workflow
 */
trait EntityWorkflow
{
    public static $DEFAULT_STATUTES = [
        'draft',
        'publish',
        'archive'
    ];

    /**
     * Entity Status
     */
    private ?string $status = null;

    /**
     * Entity Publish Date
     */
    private ?\DateTime $publishDate = null;

    /**
     * Get the value of status
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?string $status): self
    {
        if (self::isStatus($status)) {
            $this->status = $status;
        }

        return $this;
    }

    /**
     * Check if has valid status
     */
    public function hasStatus(): bool
    {
        return self::isStatus($this->getStatus());
    }

    /**
     * Check if given status is a valid status
     */
    static public function isStatus(?string $status): bool
    {
        return in_array($status, self::getStatutes());
    }

    /**
     * Get All Statutes
     * -> To redefine in classes use EntityWorkflow if different than $DEFAULT_STATUTES
     */
    static public function getStatutes(): array
    {
        return self::$DEFAULT_STATUTES;
    }

    /**
     * Get Publish Date
     */
    public function getPublishDate(): ?\DateTime
    {
        return $this->publishDate;
    }

    /**
     * Set Publish Date
     */
    public function setPublishDate(\DateTime|string|null $publishDate): self
    {
        if (is_string($publishDate)) {
            $publishDate = Utils::createDateTimeFromString($publishDate);
        }

        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Check if has a valid Publish Date
     */
    public function hasPublishDate(): bool
    {
        return $this->getPublishDate() instanceof \DateTime;
    }
}
