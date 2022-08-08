<?php

namespace App\DataFixtures;

use App\Entity\JobTitle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JobTitleFixtures extends Fixture
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

    public const JOB_TITLE_REFERENCE_1 = 'job_title_reference_1';
    

    public function load(ObjectManager $manager)
    {
        foreach (self::JOB_TITLES as $slug => $label) {
            $jobTitle = new JobTitle();
            $jobTitle->setSlug($slug);
            $jobTitle->setLabel($label);
            $manager->persist($jobTitle);
        }
        $this->addReference(self::JOB_TITLE_REFERENCE_1, $jobTitle);
        $manager->flush();
    }
}