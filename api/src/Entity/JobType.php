<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * JobType
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
#[ORM\Entity]
class JobType
{
    // const JOB_TYPES = [
    //     'expertise-comptable'   => 'Expertise comptable',
    //     'audit-commissariat'    => 'Audit / Commissariat aux comptes',
    //     'juridique'             => 'Juridique',
    //     'social-paie'           => 'Social / Paie',
    //     'conseil'               => 'Conseil',
    //     'gestion-patrimoine'    => 'Gestion de patrimoine',
    //     'transmission-cession'  => 'Transmission / Cession',
    //     'fiscalite'             => 'Fiscalité',
    //     'gestion-pilotage'      => 'Gestion / Pilotage',
    //     'informatique'          => 'Informatique',
    //     'comm-market'           => 'Communication / Marketing'
    // ];

    use Uuid;
    use Slug;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $label = null;

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
     * Check if is valid JobType
     */
    public function isValidJobType(): bool
    {
        return $this->hasSlug();
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

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }
}
