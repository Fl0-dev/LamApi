<?php

namespace App\Transversal;

use Doctrine\ORM\Mapping as ORM;

trait FieldName 
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $fieldName = null;

    public function getFieldName(): ?string
    {
        return $this->fieldName;
    }

    public function setFieldName(?string $fieldName): self
    {
        $this->fieldName = $fieldName;

        return $this;
    }
}