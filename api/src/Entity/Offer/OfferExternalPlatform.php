<?php
namespace App\Entity\Offer;

use App\Entity\Offer\Offer;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Offer External Platform
 *
 */
#[ORM\Entity]
class OfferExternalPlatform
{
    use Uuid;

    const PLATFORM_TALENTPLUG = 'talentplug';

    const AVAILABLE_PLATFORMS = [
        self::PLATFORM_TALENTPLUG => 'Talentplug'
    ];

    /**
     * Offer that matches in App Database
     *
     */
    #[ORM\OneToOne(targetEntity: Offer::class)]
    private Offer $offer;

    /**
     * Name of External Platform from which the Offer comes (Talentplug...)
     *
     */
    #[ORM\Column(type: "string")]
    private string $platform;

    /**
     * Offer ID on External Platform to let make matching
     *
     */
    #[ORM\Column(type: "string")]
    private ?string $externalId = null;

    /**
     * Constructor
     */
    public function __construct(Offer $offer, string $platform, ?string $externalId = null)
    {
        $this->setOffer($offer);
        $this->setPlatform($platform);
        $this->setExternalId($externalId);
    }

    /**
     * Get the value of offer
     */
    public function getOffer(): Offer
    {
        return $this->offer;
    }

    /**
     * Set the value of offer
     */
    public function setOffer(Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get the value of platform
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * Set the value of platform
     */
    public function setPlatform(string $platform): self
    {
        if (self::isValidPlatform($platform)) {
            $this->platform = $platform;
        }

        return $this;
    }

    /**
     * Check if has a valid Platform value
     */
    public function hasPlatform(): bool
    {
        return self::isValidPlatform($this->getPlatform());
    }

    /**
     * Check if given Platform slug is valid
     */
    public static function isValidPlatform($platform): bool
    {
        return is_string($platform) && array_key_exists($platform, self::AVAILABLE_PLATFORMS);
    }

    /**
     * Get the value of externalId
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * Set the value of externalId
     */
    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Check if has a valid External Offer ID
     */
    public function hasExternalId(): bool
    {
        $externalId = $this->getExternalId();

        return is_string($externalId) && strlen($externalId) > 0;
    }
}
