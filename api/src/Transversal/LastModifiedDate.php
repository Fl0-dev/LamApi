<?php

namespace App\Transversal;

use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait for using LastModifiedDate
 */
trait LastModifiedDate
{
    /**
     * Date when was last modified
     *
     */
    #[ORM\Column(type: "datetime", options: ["default" => 'CURRENT_TIMESTAMP'])]
    #[Groups([Offer::OPERATION_NAME_GET_OFFER_APPLICATIONS])]
    private ?\DateTime $lastModifiedDate;

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
