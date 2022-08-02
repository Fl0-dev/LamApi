<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BadgeRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:getAll'], //indique l'annotation à utiliser pour récupérer certains champs lors d'un GET All
        'openapi_definition_name' => 'Collection'//pour renommer le schéma dans la documentation
    ],
    collectionOperations: [
        "get",
        "post",
    ],
    itemOperations: [
        "get",
        "put",
        "delete",
    ],
)]
class Badge
{
    use Uuid;
    use Label;
    use Slug;

    #[Groups(["read:getAll"])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageUri;

    #[Groups(["read:getAll"])]
    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[Groups(["read:getAll"])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $badgePath;

    /**
     * Check if the given $badge is a valid Badge
     */
    public static function isBadge($badge): bool
    {
        return $badge instanceof self && $badge->hasSlug();
    }

    /**
     * Check if the given $badges array contains only valid Badge
     */
    public static function areBadges(ArrayCollection|array $badges): bool
    {
        $isOk = false;

        if ($badges instanceof ArrayCollection) {
            $badges = $badges->toArray();
        }

        if (is_array($badges)) {
            $isOk = true;

            foreach ($badges as $badge) {
                if (!self::isBadge($badge)) {
                    $isOk = false;
                }
            }
        }

        return $isOk;
    }

    public function getImageUri(): ?string
    {
        return $this->imageUri;
    }

    public function setImageUri(?string $imageUri): self
    {
        $this->imageUri = $imageUri;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBadgePath(): ?string
    {
        return $this->badgePath;
    }

    public function setBadgePath(?string $badgePath): self
    {
        $this->badgePath = $badgePath;

        return $this;
    }
}
