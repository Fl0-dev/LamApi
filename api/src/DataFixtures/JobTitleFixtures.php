<?php

namespace App\DataFixtures;

use App\Entity\JobTitle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JobTitleFixtures extends Fixture
{
    public const JOB_TITLES = [
        'assistant-administratif' => 'Assistant administratif',
        'assistant-comptable'      => 'Assistant comptable',
        'assistant-juridique-droit-des-societes'      => 'Assistant juridique - Droit des Sociétés',
        'assistant-juridique-droit-social'      => 'Assistant juridique - Droit Social',
        'auditeur-assistant' => 'Auditeur Assistant',
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
    public const JOB_TITLE_REFERENCE_2 = 'job_title_reference_2';
    public const JOB_TITLE_REFERENCE_3 = 'job_title_reference_3';
    public const JOB_TITLE_REFERENCE_4 = 'job_title_reference_4';
    public const JOB_TITLE_REFERENCE_5 = 'job_title_reference_5';
    public const JOB_TITLE_REFERENCE_6 = 'job_title_reference_6';
    public const JOB_TITLE_REFERENCE_7 = 'job_title_reference_7';
    public const JOB_TITLE_REFERENCE_8 = 'job_title_reference_8';
    public const JOB_TITLE_REFERENCE_9 = 'job_title_reference_9';
    public const JOB_TITLE_REFERENCE_10 = 'job_title_reference_10';
    public const JOB_TITLE_REFERENCE_11 = 'job_title_reference_11';
    public const JOB_TITLE_REFERENCE_12 = 'job_title_reference_12';
    public const JOB_TITLE_REFERENCE_13 = 'job_title_reference_13';
    public const JOB_TITLE_REFERENCE_14 = 'job_title_reference_14';
    public const JOB_TITLE_REFERENCE_15 = 'job_title_reference_15';
    public const JOB_TITLE_REFERENCE_16 = 'job_title_reference_16';
    public const JOB_TITLE_REFERENCE_17 = 'job_title_reference_17';
    public const JOB_TITLE_REFERENCE_18 = 'job_title_reference_18';
    public const JOB_TITLE_REFERENCE_19 = 'job_title_reference_19';
    public const JOB_TITLE_REFERENCE_20 = 'job_title_reference_20';
    public const JOB_TITLE_REFERENCE_21 = 'job_title_reference_21';
    public const JOB_TITLE_REFERENCE_22 = 'job_title_reference_22';
    public const JOB_TITLE_REFERENCE_23 = 'job_title_reference_23';
    public const JOB_TITLE_REFERENCE_24 = 'job_title_reference_24';
    public const JOB_TITLE_REFERENCE_25 = 'job_title_reference_25';
    public const JOB_TITLE_REFERENCE_26 = 'job_title_reference_26';
    public const JOB_TITLE_REFERENCE_27 = 'job_title_reference_27';
    public const JOB_TITLE_REFERENCE_28 = 'job_title_reference_28';
    public const JOB_TITLE_REFERENCE_29 = 'job_title_reference_29';
    public const JOB_TITLE_REFERENCE_30 = 'job_title_reference_30';
    public const JOB_TITLE_REFERENCE_31 = 'job_title_reference_31';
    public const JOB_TITLE_REFERENCE_32 = 'job_title_reference_32';
    public const JOB_TITLE_REFERENCE_33 = 'job_title_reference_33';
    public const JOB_TITLE_REFERENCE_34 = 'job_title_reference_34';

    public function load(ObjectManager $manager): void
    {
        $jobTitle = new JobTitle();
        $jobTitle->setSlug('assistant-administratif');
        $jobTitle->setLabel('Assistant administratif');
        $this->addReference(self::JOB_TITLE_REFERENCE_1, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('assistant-comptable');
        $jobTitle->setLabel('Assistant comptable');
        $this->addReference(self::JOB_TITLE_REFERENCE_2, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('assistant-juridique-droit-des-societes');
        $jobTitle->setLabel('Assistant juridique - Droit des Sociétés');
        $this->addReference(self::JOB_TITLE_REFERENCE_3, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('assistant-juridique-droit-social');
        $jobTitle->setLabel('Assistant juridique - Droit Social');
        $this->addReference(self::JOB_TITLE_REFERENCE_4, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('auditeur-assistant');
        $jobTitle->setLabel('Auditeur Assistant');
        $this->addReference(self::JOB_TITLE_REFERENCE_5, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('autres-metiers');
        $jobTitle->setLabel('Autres métiers');
        $this->addReference(self::JOB_TITLE_REFERENCE_6, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('avocat-droit-des-societes');
        $jobTitle->setLabel('Avocat - Droit des Sociétés');
        $this->addReference(self::JOB_TITLE_REFERENCE_7, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('avocat-droit-social');
        $jobTitle->setLabel('Avocat - Droit Social');
        $this->addReference(self::JOB_TITLE_REFERENCE_8, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('chef-de-mission-audit');
        $jobTitle->setLabel('Chef de mission Audit');
        $this->addReference(self::JOB_TITLE_REFERENCE_9, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('chef-de-mission-comptable');
        $jobTitle->setLabel('Chef de mission Comptable');
        $this->addReference(self::JOB_TITLE_REFERENCE_10, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('collaborateur-comptable');
        $jobTitle->setLabel('Collaborateur Comptable');
        $this->addReference(self::JOB_TITLE_REFERENCE_11, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('collaborateur-comptable-et-audit');
        $jobTitle->setLabel('Collaborateur Comptable et Audit');
        $this->addReference(self::JOB_TITLE_REFERENCE_12, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('communication-marketing');
        $jobTitle->setLabel('Communication / Marketing');
        $this->addReference(self::JOB_TITLE_REFERENCE_13, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('consultant-junior');
        $jobTitle->setLabel('Consultant Junior');
        $this->addReference(self::JOB_TITLE_REFERENCE_14, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('consultant-manager');
        $jobTitle->setLabel('Consultant Manager');
        $this->addReference(self::JOB_TITLE_REFERENCE_15, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('consultant-senior');
        $jobTitle->setLabel('Consultant Senior');
        $this->addReference(self::JOB_TITLE_REFERENCE_16, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('controleur-de-gestion');
        $jobTitle->setLabel('Contrôleur de gestion');
        $this->addReference(self::JOB_TITLE_REFERENCE_17, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('directeur-audit');
        $jobTitle->setLabel('Directeur Audit');
        $this->addReference(self::JOB_TITLE_REFERENCE_18, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('expert-comptable');
        $jobTitle->setLabel('Expert Comptable');
        $this->addReference(self::JOB_TITLE_REFERENCE_19, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('expert-comptable-stagiaire');
        $jobTitle->setLabel('Expert Comptable Stagiaire');
        $this->addReference(self::JOB_TITLE_REFERENCE_20, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('fiscalite');
        $jobTitle->setLabel('Fiscalité');
        $this->addReference(self::JOB_TITLE_REFERENCE_21, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('gestion-pilotage');
        $jobTitle->setLabel('Gestion / Pilotage');
        $this->addReference(self::JOB_TITLE_REFERENCE_22, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('gestion de patrimoine');
        $jobTitle->setLabel('Gestion de patrimoine');
        $this->addReference(self::JOB_TITLE_REFERENCE_23, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('gestionnaire-de-paie');
        $jobTitle->setLabel('Gestionnaire de paie');
        $this->addReference(self::JOB_TITLE_REFERENCE_24, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('juriste-droit-des-societes');
        $jobTitle->setLabel('Juriste - Droit des Sociétés');
        $this->addReference(self::JOB_TITLE_REFERENCE_25, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('juriste-droit-social');
        $jobTitle->setLabel('Juriste - Droit Social');
        $this->addReference(self::JOB_TITLE_REFERENCE_26, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('manager-audit');
        $jobTitle->setLabel('Manager Audit');
        $this->addReference(self::JOB_TITLE_REFERENCE_27, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('manager-comptable');
        $jobTitle->setLabel('Manager Comptable');
        $this->addReference(self::JOB_TITLE_REFERENCE_28, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('numerique');
        $jobTitle->setLabel('Numérique');
        $this->addReference(self::JOB_TITLE_REFERENCE_29, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('responsable-paie');
        $jobTitle->setLabel('Responsable Paie');
        $this->addReference(self::JOB_TITLE_REFERENCE_30, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('ressources-humaines');
        $jobTitle->setLabel('Ressources Humaines');
        $this->addReference(self::JOB_TITLE_REFERENCE_31, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('secretaire-juridique');
        $jobTitle->setLabel('Secrétaire Juridique');
        $this->addReference(self::JOB_TITLE_REFERENCE_32, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('senior-manager-audit');
        $jobTitle->setLabel('Senior Manager Audit');
        $this->addReference(self::JOB_TITLE_REFERENCE_33, $jobTitle);
        $manager->persist($jobTitle);

        $jobTitle = new JobTitle();
        $jobTitle->setSlug('transmission-cession');
        $jobTitle->setLabel('Transmission / Cession');
        $this->addReference(self::JOB_TITLE_REFERENCE_34, $jobTitle);
        $manager->persist($jobTitle);

        $manager->flush();
    }
}
