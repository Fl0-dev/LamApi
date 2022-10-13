<?php

namespace App\DataFixtures;

use App\Entity\Applicant\ApplicantCv;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicantCvFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPLICANT_CV_REFERENCE_1 = 'application_cv_1';
    public const APPLICANT_CV_REFERENCE_2 = 'application_cv_2';
    public const APPLICANT_CV_REFERENCE_3 = 'application_cv_3';
    public const APPLICANT_CV_REFERENCE_4 = 'application_cv_4';
    public const APPLICANT_CV_REFERENCE_5 = 'application_cv_5';
    public const APPLICANT_CV_REFERENCE_6 = 'application_cv_6';
    public const APPLICANT_CV_REFERENCE_7 = 'application_cv_7';
    public const APPLICANT_CV_REFERENCE_8 = 'application_cv_8';
    public const APPLICANT_CV_REFERENCE_9 = 'application_cv_9';
    public const APPLICANT_CV_REFERENCE_10 = 'application_cv_10';
    public const APPLICANT_CV_REFERENCE_11 = 'application_cv_11';
    public const APPLICANT_CV_REFERENCE_12 = 'application_cv_12';

    public function load(ObjectManager $manager): void
    {
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv1.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_1));
        $this->addReference(self::APPLICANT_CV_REFERENCE_1, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv2.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $this->addReference(self::APPLICANT_CV_REFERENCE_2, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv3.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_3));
        $this->addReference(self::APPLICANT_CV_REFERENCE_3, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv4.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_4));
        $this->addReference(self::APPLICANT_CV_REFERENCE_4, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv5.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_5));
        $this->addReference(self::APPLICANT_CV_REFERENCE_5, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv6.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_6));
        $this->addReference(self::APPLICANT_CV_REFERENCE_6, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv7.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_7));
        $this->addReference(self::APPLICANT_CV_REFERENCE_7, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv8.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_8));
        $this->addReference(self::APPLICANT_CV_REFERENCE_8, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setFilePath('cv9.pdf');
        $cv->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_9));
        $this->addReference(self::APPLICANT_CV_REFERENCE_9, $cv);
        $manager->persist($cv);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ApplicantFixtures::class,
        ];
    }
}
