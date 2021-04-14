<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Utils\Utils;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company Subscription
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class Subscription
{
    const SUBSCRIPTION_SLUG_BEGINNER = 'beginner';
    const SUBSCRIPTION_SLUG_RECRUITER = 'recruiter';
    const SUBSCRIPTION_SLUG_EMPLOYER_BRAND = 'employer_brand';

    const SUBSCRIPTIONS = [
        self::SUBSCRIPTION_SLUG_BEGINNER => 'Débutant',
        self::SUBSCRIPTION_SLUG_RECRUITER => 'Recruteur',
        self::SUBSCRIPTION_SLUG_EMPLOYER_BRAND => 'Marque Employeur'
    ];

    const SUBSCRIPTION_SLUG_DEFAULT = self::SUBSCRIPTION_SLUG_BEGINNER;

    /**
     * Slug
     *
     * @ApiProperty(identifier=true)
     */
    #[Assert\NotBlank]
    private string $slug;

    /**
     * Constructor
     */
    public function __construct(?string $slug = null)
    {
        $this->setSlug($slug);
    }

    /**
     * Get Slug
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set Slug
     */
    public function setSlug(string $slug): self
    {
        if (self::isSlug($slug)) {
            $this->slug = $slug;
        }

        return $this;
    }

    /**
     * Check if the has a valid Slug value
     */
    public function hasSlug(): bool
    {
        return self::isSlug($this->getSlug());
    }

    /**
     * Check if given Subscription Slug is valid
     */
    static public function isSlug(string $slug): bool
    {
        return is_string($slug) && array_key_exists($slug, self::SUBSCRIPTIONS);
    }

    /**
     * Get Label
     */
    public function getLabel(): string
    {
        if ($this->hasSlug()) {
            return Utils::getArrayValue($this->getSlug(), self::SUBSCRIPTIONS);
        }

        return null;
    }
}
