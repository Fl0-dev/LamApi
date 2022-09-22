<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Offer\Offer;
use App\Repository\JobTitleRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JobTitleRepository::class)]
#[ApiResource()]
#[ApiFilter(SearchFilter::class, properties: ['slug' => 'ipartial'])]
class JobTitle
{
    const JOB_TITLES = [
        'assistant-administratif' => 'Assistant administratif',
        'assistant-comptable'      => 'Assistant comptable',
        'assistant-juridique-droit-des-societes'      => 'Assistant juridique - Droit des Sociétés',
        'assistant-juridique-droit-social'      => 'Assistant juridique - Droit Social',
        'auditeur-assistant' =>'Auditeur Assistant',
        'autres-metiers' => 'Autres métiers',
        'avocat-droit-des-societes' => 'Avocat - Droit des Sociétés',
        'avocat-droit-social' => 'Avocat - Droit Social',
        'chef-de-mission-audit' => 'Chef de Mission Audit',
        'chef-de-mission-comptable' => 'Chef de Mission Comptable',
        'collaborateur-comptable' => 'Collaborateur Comptable',
        'collaborateur-comptable-et-audit' => 'Collaborateur Comptable et Audit',
        'communication-marketing' => 'Communication / Marketing',
        'consultant-junior' => 'Consultant Junior',
        'consultant-manager' => 'Consultant Manager',
        'consultant-senior' => 'Consultant Senior',
        'controleur-de-gestion' => 'Contrôleur de Gestion',
        'directeur-audit' => 'Directeur Audit',
        'expert-comptable' => 'Expert-Comptable',
        'expert-comptable-stagiaire' => 'Expert-Comptable Stagiaire',
        'fiscalite' => 'Fiscalité',
        'gestion-pilotage' => 'Gestion / Pilotage',
        'gestion de patrimoine' => 'Gestion de patrimoine',
        'gestionnaire-de-paie' => 'Gestionnaire de Paie',
        'juriste-droit-des-societes' => 'Juriste - Droit des Sociétés',
        'juriste-droit-social' => 'Juriste - Droit Social',
        'manager-audit' => 'Manager Audit',
        'manager-comptable' => 'Manager Comptable',
        'numerique' => 'Numérique',
        'responsable-paie' => 'Responsable Paie',
        'ressources-humaines' => 'Ressources Humaines',
        'secretaire-juridique' => 'Secrétaire Juridique',
        'senior-manager-audit' => 'Senior Manager Audit',
        'transmission-cession' => 'Transmission / Cession'
    ];
    use Uuid;
    use Slug;
    use Label;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    private $jobTypes;

    public function __construct()
    {
        $this->jobTypes = new ArrayCollection();
    }

    #[Groups([Offer::OPERATION_NAME_GET_OFFER_DETAILS])]
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return Collection<int, JobType>
     */
    public function getJobTypes(): Collection
    {
        return $this->jobTypes;
    }

    public function addJobType(JobType $jobType): self
    {
        if (!$this->jobTypes->contains($jobType)) {
            $this->jobTypes[] = $jobType;
        }

        return $this;
    }

    public function removeJobType(JobType $jobType): self
    {
        $this->jobTypes->removeElement($jobType);

        return $this;
    }
}
