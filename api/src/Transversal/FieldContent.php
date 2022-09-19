<?php

namespace App\Transversal;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait FieldContent 
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fieldContent = null;

    public function getFieldContent(): ?string
    {
        return $this->fieldContent;
    }

    public function setFieldContent(?string $fieldContent): self
    {
        $this->fieldContent = $fieldContent;

        return $this;
    }
}