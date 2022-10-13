<?php

namespace App\Entity\References;

use ApiPlatform\Metadata\ApiProperty;
use App\Transversal\Label;
use App\Transversal\Slug;
use Symfony\Component\Uid\Uuid;

abstract class Reference
{
    use Slug;
    use Label;

    #[ApiProperty(identifier: true)]
    private $id;

    public function __construct(string $slug, string $label)
    {
        $this->id = Uuid::v3(Uuid::fromString(Uuid::NAMESPACE_URL), $slug);
        $this->slug = $slug;
        $this->label = $label;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
