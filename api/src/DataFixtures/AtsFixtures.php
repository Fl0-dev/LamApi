<?php

namespace App\DataFixtures;

use App\Entity\Ats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AtsFixtures extends Fixture
{
    public const ATS_REFERENCE_1 = 'ats1';
    public const ATS_REFERENCE_2 = 'ats2';
    public const ATS_REFERENCE_3 = 'ats3';
    public const ATS_REFERENCE_4 = 'ats4';
    public const ATS_REFERENCE_5 = 'ats5';
    public const ATS_REFERENCE_6 = 'ats6';
    public const ATS_REFERENCE_7 = 'ats7';
    public const ATS_REFERENCE_8 = 'ats8';

    public function load(ObjectManager $manager): void
    {
        $ats = new Ats();
        $ats->setName('Digital Recruiters');
        $ats->setSlug('digital-recruiters');
        $ats->setDescription('description de Digital Recruiters');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_1, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('Flatchr');
        $ats->setSlug('flatchr');
        $ats->setDescription('description de Flatchr');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_2, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('RhProfiler');
        $ats->setSlug('rhprofiler');
        $ats->setDescription('description de RhProfiler');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_3, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('Taleez');
        $ats->setSlug('taleez');
        $ats->setDescription('description de Taleez');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_4, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('TalentDetection');
        $ats->setSlug('talentdetection');
        $ats->setDescription('description de TalentDetection');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_5, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('TalentPlug');
        $ats->setSlug('talentplug');
        $ats->setDescription('description de TalentPlug');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_6, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('Teamtailor');
        $ats->setSlug('teamtailor');
        $ats->setDescription('description de Teamtailor');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_7, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setName('WeRecruit');
        $ats->setSlug('werecruit');
        $ats->setDescription('description de WeRecruit');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_8, $ats);
        $manager->persist($ats);

        $manager->flush();
    }
}
