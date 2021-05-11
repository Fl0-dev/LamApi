<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * JobType
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class JobType
{
    const JOB_TYPES = [
        'expertise-comptable'   => 'Expertise comptable',
        'audit-commissariat'    => 'Audit / Commissariat aux comptes',
        'juridique'             => 'Juridique',
        'social-paie'           => 'Social / Paie',
        'conseil'               => 'Conseil',
        'gestion-patrimoine'    => 'Gestion de patrimoine',
        'transmission-cession'  => 'Transmission / Cession',
        'fiscalite'             => 'Fiscalité',
        'gestion-pilotage'      => 'Gestion / Pilotage',
        'informatique'          => 'Informatique',
        'comm-market'           => 'Communication / Marketing'
    ];

    /**
     * JobType Slug
     *
     * @ApiProperty(identifier=true)
     */
    private ?string $slug = null;

    /**
     * Constructor
     */
    public function __construct(?string $slug = null)
    {
        $this->setSlug($slug);
    }

    public function __toString()
    {
        return $this->getSlug();
    }

    /**
     * Get JobType Slug
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set JobType Slug
     */
    public function setSlug($slug): self
    {
        if (self::isValidSlug($slug)) {
            $this->slug = $slug;
        }

        return $this;
    }

    /**
     * Check if JobType has a valid Slug value
     */
    public function hasSlug(): bool
    {
        return self::isValidSlug($this->getSlug());
    }

    /**
     * Check if given JobType Slug is valid
     */
    public static function isValidSlug($slug): bool
    {
        return is_string($slug) && array_key_exists($slug, self::JOB_TYPES);
    }

    /**
     * Check if is valid JobType
     */
    public function isValidJobType(): bool
    {
        return $this->hasSlug();
    }

    /**
     * Get JobType Label
     */
    public function getLabel(): ?string
    {
        if ($this->hasSlug()) {
            return self::JOB_TYPES[$this->getSlug()];
        }

        return null;
    }

    /**
     * Check if the given $jobType is a valid JobType
     */
    public static function isJobType($jobType): bool
    {
        return $jobType instanceof self && $jobType->hasSlug();
    }

    /**
     * Check if the given $jobTypes array contains only valid JobType
     */
    public static function areJobTypes(ArrayCollection|array $jobTypes): bool
    {
        $isOk = false;

        if ($jobTypes instanceof ArrayCollection) {
            $jobTypes = $jobTypes->toArray();
        }

        if (is_array($jobTypes)) {
            $isOk = true;

            foreach ($jobTypes as $jobType) {
                if (!self::isJobType($jobType)) {
                    $isOk = false;
                }
            }
        }

        return $isOk;
    }
}
