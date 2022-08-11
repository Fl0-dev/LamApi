<?php

namespace App\Transversal;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait for using Label
 */
trait Label
{
    /**
     * Label
     *
     */
    #[Groups(["read:getAll", 'read:getCompanyGroupDetails'])]
    #[ORM\Column(type: "string", length: 255)]
    private ?string $label = null;

    /**
     * Get Label value
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Set Label value
     */
    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Check if has a valid Label
     */
    public function hasLabel(): bool
    {
        $label = $this->getLabel();

        return is_string($label) && strlen($label) > 0;
    }

}