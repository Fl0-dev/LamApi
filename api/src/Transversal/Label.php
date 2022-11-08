<?php

namespace App\Transversal;

use App\Entity\Company\CompanyGroup;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Trait for using Label
 */
trait Label
{
    /**
     * Label
     *
     */
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    #[ORM\Column(type: "string", length: 255)]
    #[Length(
        min: 3,
        max: 255,
        minMessage: "The label must contain at least {{ limit }} characters",
        maxMessage: "The label must not exceed {{ limit }} characters"
    )]
    #[Assert\NotNull()]
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
