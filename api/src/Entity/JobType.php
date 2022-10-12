<?php

namespace App\Entity;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\JobTypeRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(operations: [
    new Get(),
    new Put(),
    new Delete(),
    new GetCollection(),
    new Post()
    ])]
#[ORM\Entity(repositoryClass: JobTypeRepository::class)]
#[ApiFilter(filterClass: SearchFilter::class, properties: ['slug' => 'ipartial'])]
class JobType
{
    use Uuid;
    use Slug;
    use Label;
    public const JOB_TYPES = [
        'expertise-comptable' => 'Expertise comptable',
        'audit-commissariat' => 'Audit / Commissariat aux comptes',
        'juridique' => 'Juridique',
        'social-paie' => 'Social / Paie',
        'conseil' => 'Conseil',
        'gestion-patrimoine' => 'Gestion de patrimoine',
        'transmission-cession' => 'Transmission / Cession',
        'fiscalite' => 'Fiscalité',
        'gestion-pilotage' => 'Gestion / Pilotage',
        'evaluation' => 'Evaluation',
        'consolidation' => 'Consolidation',
        'daf-externalise' => 'DAF externisé',
        'recherche-de-financement' => 'Recherche de financement',
        'numerique' => 'Numérique',
        'comm-market' => 'Communication / Marketing',
        'administratif' => 'Administratif'
    ];

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
}
