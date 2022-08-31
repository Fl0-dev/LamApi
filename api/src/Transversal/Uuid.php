<?php

namespace App\Transversal;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid as BaseUuid;

/**
 * Trait for using Uuid
 */
trait Uuid
{
    /**
     * Uuid Property
     *
     */
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    #[ApiProperty(identifier: true)]
    private ?BaseUuid $id = null;

    /**
     * Get Uuid value
     */
    public function getId(): ?BaseUuid
    {
        return $this->id;
    }

    /**
     * Set Uuid value
     */
    public function setId(BaseUuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Check if Uuid has a valid value
     */
    public function hasId(): bool
    {
        return $this->id instanceof BaseUuid;
    }
}
