<?php

namespace App\DataFixtures;

use App\Entity\JobType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobTypeFixtures extends Fixture
{
    public const JOB_TYPE_REFERENCE_0 = 'job_type_0';
    public const JOB_TYPE_REFERENCE_1 = 'job_type_1';
    public const JOB_TYPE_REFERENCE_2 = 'job_type_2';
    public const JOB_TYPE_REFERENCE_3 = 'job_type_3';
    public const JOB_TYPE_REFERENCE_4 = 'job_type_4';
    public const JOB_TYPE_REFERENCE_5 = 'job_type_5';
    public const JOB_TYPE_REFERENCE_6 = 'job_type_6';
    public const JOB_TYPE_REFERENCE_7 = 'job_type_7';
    public const JOB_TYPE_REFERENCE_8 = 'job_type_8';
    public const JOB_TYPE_REFERENCE_9 = 'job_type_9';
    public const JOB_TYPE_REFERENCE_10 = 'job_type_10';
    public const JOB_TYPE_REFERENCE_11 = 'job_type_11';
    public const JOB_TYPE_REFERENCE_12 = 'job_type_12';
    public const JOB_TYPE_REFERENCE_13 = 'job_type_13';
    public const JOB_TYPE_REFERENCE_14 = 'job_type_14';
    public const JOB_TYPE_REFERENCE_15 = 'job_type_15';

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

            $jobType = new JobType();
            $jobType->setSlug('expertise-comptable');
            $jobType->setLabel('Expertise comptable');
            $this->addReference(self::JOB_TYPE_REFERENCE_0, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('audit-commissariat' );
            $jobType->setLabel('Audit / Commissariat aux comptes');
            $this->addReference(self::JOB_TYPE_REFERENCE_1, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('juridique');
            $jobType->setLabel('Juridique');
            $this->addReference(self::JOB_TYPE_REFERENCE_2, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('social-paie');
            $jobType->setLabel('Social / Paie');
            $this->addReference(self::JOB_TYPE_REFERENCE_3, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('conseil');
            $jobType->setLabel('Conseil');
            $this->addReference(self::JOB_TYPE_REFERENCE_4, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('gestion-patrimoine');
            $jobType->setLabel('Gestion de patrimoine');
            $this->addReference(self::JOB_TYPE_REFERENCE_5, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('transmission-cession');
            $jobType->setLabel('Transmission / Cession');
            $this->addReference(self::JOB_TYPE_REFERENCE_6, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('fiscalite');
            $jobType->setLabel('Fiscalité');
            $this->addReference(self::JOB_TYPE_REFERENCE_7, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('gestion-pilotage');
            $jobType->setLabel('Gestion / Pilotage');
            $this->addReference(self::JOB_TYPE_REFERENCE_8, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('evaluation');
            $jobType->setLabel('Evaluation');
            $this->addReference(self::JOB_TYPE_REFERENCE_9, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('consolidation');
            $jobType->setLabel('Consolidation');
            $this->addReference(self::JOB_TYPE_REFERENCE_10, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('daf-externalise');
            $jobType->setLabel('DAF externisé');
            $this->addReference(self::JOB_TYPE_REFERENCE_11, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('recherche-de-financement');
            $jobType->setLabel('Recherche de financement');
            $this->addReference(self::JOB_TYPE_REFERENCE_12, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('numerique');
            $jobType->setLabel('Numérique');
            $this->addReference(self::JOB_TYPE_REFERENCE_13, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('comm-market');
            $jobType->setLabel('Communication / Marketing');
            $this->addReference(self::JOB_TYPE_REFERENCE_14, $jobType);
            $manager->persist($jobType);

            $jobType = new JobType();
            $jobType->setSlug('administratif');
            $jobType->setLabel('Administratif');
            $this->addReference(self::JOB_TYPE_REFERENCE_15, $jobType);
            $manager->persist($jobType);

        $manager->flush();
    }
}