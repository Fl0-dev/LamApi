<?php

namespace App\DataFixtures;

use App\Entity\JobType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobTypeFixtures extends Fixture
{
    public const JOB_TYPE_REFERENCE_0 = 'expertise-comptable';
    public const JOB_TYPE_REFERENCE_1 = 'audit-commissariat';
    public const JOB_TYPE_REFERENCE_2 = 'juridique';
    public const JOB_TYPE_REFERENCE_3 = 'social-paie';
    public const JOB_TYPE_REFERENCE_4 = 'conseil';
    public const JOB_TYPE_REFERENCE_5 = 'gestion-patrimoine';
    public const JOB_TYPE_REFERENCE_6 = 'transmission-cession';
    public const JOB_TYPE_REFERENCE_7 = 'fiscalite';
    public const JOB_TYPE_REFERENCE_8 = 'gestion/pilotage';
    public const JOB_TYPE_REFERENCE_9 = 'evaluation';
    public const JOB_TYPE_REFERENCE_10 = 'consolidation';
    public const JOB_TYPE_REFERENCE_11 = 'daf-externalise';
    public const JOB_TYPE_REFERENCE_12 = 'recherche-de-financement';
    public const JOB_TYPE_REFERENCE_13 = 'numerique';
    public const JOB_TYPE_REFERENCE_14 = 'comm-market';
    public const JOB_TYPE_REFERENCE_15 = 'administratif';

    public function load(ObjectManager $manager): void
    {
        $jobType = new JobType();
        $jobType->setSlug('expertise-comptable');
        $jobType->setLabel('Expertise comptable');
        $this->addReference(self::JOB_TYPE_REFERENCE_0, $jobType);
        $manager->persist($jobType);

        $jobType = new JobType();
        $jobType->setSlug('audit-commissariat');
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
