<?php

namespace App\Transversal;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4 as SFUuid;

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
    #[ORM\CustomIdGenerator(class: SFUuid::class)]
    #[ApiProperty(identifier: true)]
    private ?SFUuid $id = null;

    /**
     * Get Uuid value
     */
    public function getId(): ?SFUuid
    {
        return $this->id;
    }

    /**
     * Set Uuid value
     */
    public function setId(SFUuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Check if Uuid has a valid value
     */
    public function hasId(): bool
    {
        return $this->id instanceof SFUuid;
    }
}
