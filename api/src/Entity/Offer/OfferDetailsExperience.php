<?php

namespace App\Entity\Offer;

use Doctrine\ORM\Mapping as ORM;
use App\Utils\Utils;

/**
 * Offer Details Experience
 */
trait OfferDetailsExperience
{
    /**
     * ID of Experience required for this Offer
     *
     */
    #[ORM\Column(type: "integer")]
    private ?int $experience = null;

    /**
     * Get ID of Experience required for this Offer
     */
    public function getExperience(): ?int
    {
        return $this->experience;
    }

    /**
     * Get full label for the Offer Experience
     */
    public function getExperienceFull(): ?string
    {
        if ($this->hasExperience()) {
            return self::getExperiencesRefFull()[$this->getExperience()];
        }

        return null;
    }

    /**
     * Get short label for the Offer Experience
     */
    public function getExperienceLabel(): ?string
    {
        if ($this->hasExperience()) {
            return self::getExperiencesRefLabel()[$this->getExperience()];
        }

        return null;
    }

    /**
     * Get duration for the Offer Experience
     */
    public function getExperienceDuration(): ?string
    {
        if ($this->hasExperience()) {
            return self::getExperiencesRefDuration()[$this->getExperience()];
        }

        return null;
    }

    /**
     * Set Experience required for this offer
     */
    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Check if Offer has a valid Experience value
     */
    public function hasExperience(): bool
    {
        return $this->isExperience($this->getExperience());
    }

    /**
     * Get Experience ID from Full Labels
     */
    public static function getExperienceIdFromFullLabel(?string $fullLabel): int|false
    {
        $experiences = self::getExperiencesRefFull();

        return array_search($fullLabel, $experiences);
    }

    /**
     * Get all full labels of experience references
     */
    public static function getExperiencesRefFull(): array
    {
        $experiences = self::getExperiencesRef();

        return Utils::arrayColumnWithKeys($experiences, 'full');
    }

    /**
     * Get all short labels of experience references
     */
    public static function getExperiencesRefLabel(): array
    {
        $experiences = self::getExperiencesRef();

        return Utils::arrayColumnWithKeys($experiences, 'label');
    }

    /**
     * Get all durations of experience references
     */
    public static function getExperiencesRefDuration(): array
    {
        $experiences = self::getExperiencesRef();

        return Utils::arrayColumnWithKeys($experiences, 'duration');
    }

    /**
     * Check if given candidate experience id is a valid candidate experience id
     */
    public static function isExperience(mixed $experience): bool
    {
        return is_int($experience) && array_key_exists($experience, self::getExperiencesRef());
    }

    /**
     * Define and get references of candidate experiences
     */
    public static function getExperiencesRef(): array
    {
        return [
            0 => [
                'full'      => 'Non précisé',
                'label'     => 'Non précisé',
                'duration'  => 'Non précisé'
            ],
            1 => [
                'full'      => 'Lamajunior (- 1 an)',
                'label'     => 'Lamajunior',
                'duration'  => "< 1 an d'expérience"
            ],
            2 => [
                'full'      => 'Lamaffirmé (1 à 2 ans)',
                'label'     => 'Lamaffirmé',
                'duration'  => "de 1 à 2 ans d'expérience"
            ],
            3 => [
                'full'      => 'Lamasenior (2 à 5 ans)',
                'label'     => 'Lamasenior',
                'duration'  => "de 2 à 5 ans d'expérience"
            ],
            4 => [
                'full'      => 'Lamexpert (+ 5 ans)',
                'label'     => 'Lamexpert',
                'duration'  => "+ de 5 ans d'expérience"
            ]
        ];
    }
}
