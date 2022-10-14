<?php

namespace App\DataFixtures;

use App\Entity\Ats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('digital-recruiters@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('Digital Recruiters');
        $ats->setSlug('digital-recruiters');
        $ats->setcontactEmail('contact@digital-recruiters.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de Digital Recruiters');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_1, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('flatchr@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('Flatchr');
        $ats->setSlug('flatchr');
        $ats->setcontactEmail('contact@flatchr.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de Flatchr');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_2, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('rhprofiler@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('RhProfiler');
        $ats->setSlug('rhprofiler');
        $ats->setcontactEmail('contact@rhprofiler.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de RhProfiler');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_3, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('taleez@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('Taleez');
        $ats->setSlug('taleez');
        $ats->setcontactEmail('contact@taleez.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de Taleez');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_4, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('talentdetection@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('TalentDetection');
        $ats->setSlug('talentdetection');
        $ats->setcontactEmail('contact@talentdetection.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de TalentDetection');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_5, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('talentplug@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('TalentPlug');
        $ats->setSlug('talentplug');
        $ats->setcontactEmail('contact@talentplug.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de TalentPlug');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_6, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('teamtailor@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('Teamtailor');
        $ats->setSlug('teamtailor');
        $ats->setcontactEmail('contact@teamtailor.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de Teamtailor');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_7, $ats);
        $manager->persist($ats);

        $ats = new Ats();
        $ats->setCreatedDate(new \DateTime());
        $ats->setLastModifiedDate(new \DateTime());
        $ats->setEmail('werecruit@gmail.com');
        $ats->setPassword($this->hasher->hashPassword($ats, 'password'));
        $ats->setName('WeRecruit');
        $ats->setSlug('werecruit');
        $ats->setcontactEmail('contact@werecruit.com');
        $ats->setcontactPhone('0123456789');
        $ats->setDescription('description de WeRecruit');
        $ats->setFree(true);
        $this->addReference(self::ATS_REFERENCE_8, $ats);
        $manager->persist($ats);

        $manager->flush();
    }
}
