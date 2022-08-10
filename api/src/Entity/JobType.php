<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Filter\JobFilter;
use App\Repository\JobTypeRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobTypeRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:getAll', 'read:getAllCompanyGroups'], //indique l'annotation à utiliser pour récupérer certains champs lors d'un GET All
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
#[ApiFilter(SearchFilter::class, properties: ["slug" => "ipartial"])]
class JobType
{
    const JOB_TYPES = [
        'expertise-comptable'       => 'Expertise comptable',
        'audit-commissariat'        => 'Audit / Commissariat aux comptes',
        'juridique'                 => 'Juridique',
        'social-paie'               => 'Social / Paie',
        'conseil'                   => 'Conseil',
        'gestion-patrimoine'        => 'Gestion de patrimoine',
        'transmission-cession'      => 'Transmission / Cession',
        'fiscalite'                 => 'Fiscalité',
        'gestion-pilotage'          => 'Gestion / Pilotage',
        'evaluation'                => 'Evaluation',
        'consolidation'             => 'Consolidation',
        'daf-externalise'           => 'DAF externisé',
        'recherche-de-financement'  => 'Recherche de financement',
        'numerique'                 => 'Numérique',
        'comm-market'               => 'Communication / Marketing',
        'administratif'             => 'Administratif'
    ];

    use Uuid;
    use Slug;
    use Label;

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
