<?php

namespace App\DataFixtures;

use App\Entity\ApplicantCv;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ApplicantCvFixtures extends Fixture
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

    public function load(ObjectManager $manager)
    {
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV1');
        $cv->setFilePath('cv1.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_1, $cv);
        $manager->persist($cv);
        
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV2');
        $cv->setFilePath('cv2.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_2, $cv);
        $manager->persist($cv);
        
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV3');
        $cv->setFilePath('cv3.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_3, $cv);
        $manager->persist($cv);
        
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV4');
        $cv->setFilePath('cv4.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_4, $cv);
        $manager->persist($cv);
        
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV5');
        $cv->setFilePath('cv5.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_5, $cv);
        $manager->persist($cv);
        
        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV6');
        $cv->setFilePath('cv6.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_6, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV7');
        $cv->setFilePath('cv7.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_7, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV8');
        $cv->setFilePath('cv8.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_8, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV9');
        $cv->setFilePath('cv9.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_9, $cv);
        $manager->persist($cv);

        $cv = new ApplicantCv();
        $cv->setCreatedDate(new \DateTime('now'));
        $cv->setLastModifiedDate(new \DateTime('now'));
        $cv->setLabel('CV10');
        $cv->setFilePath('cv10.pdf');
        $this->addReference(self::APPLICANT_CV_REFERENCE_10, $cv);
        $manager->persist($cv);

        $manager->flush();
    }
}