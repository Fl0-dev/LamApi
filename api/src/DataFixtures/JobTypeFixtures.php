<?php

namespace App\DataFixtures;

use App\Entity\JobType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobTypeFixtures extends Fixture
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

    public function load(ObjectManager $manager)
    {
        foreach (self::JOB_TYPES as $slug => $label) {
            $jobType = new JobType();
            $jobType->setSlug($slug);
            $jobType->setLabel($label);
            $manager->persist($jobType);
        }
        
        $manager->flush();
    }
}