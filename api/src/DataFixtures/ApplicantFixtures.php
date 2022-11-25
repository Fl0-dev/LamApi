<?php

namespace App\DataFixtures;

use App\Entity\Applicant\Applicant;
use App\Entity\References\ApplicantStatus;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApplicantFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPLICANT_REFERENCE_1 = 'applicant_1';
    public const APPLICANT_REFERENCE_2 = 'applicant_2';
    public const APPLICANT_REFERENCE_3 = 'applicant_3';
    public const APPLICANT_REFERENCE_4 = 'applicant_4';
    public const APPLICANT_REFERENCE_5 = 'applicant_5';
    public const APPLICANT_REFERENCE_6 = 'applicant_6';
    public const APPLICANT_REFERENCE_7 = 'applicant_7';
    public const APPLICANT_REFERENCE_8 = 'applicant_8';
    public const APPLICANT_REFERENCE_9 = 'applicant_9';

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('j-e@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Jean-Eudes');
        $applicant->setLastName('Gally');
        $applicant->setBirthdate(new \DateTime('1980-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/jean-eudes-gally-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'BAC + 2', 4))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_1, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('estelle@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Estelle');
        $applicant->setLastName('François');
        $applicant->setBirthdate(new \DateTime('1990-01-01'));
        $applicant->setDefaultMotivationText('Je suis une candidat hyper motivée');
        $applicant->setLinkedin('https://www.linkedin.com/in/estelle-fran%C3%A7ois-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'BAC + 2', 4))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_2, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('esteban@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Esteban');
        $applicant->setLastName('Carlos');
        $applicant->setBirthdate(new \DateTime('1970-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat moyennement motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/esteban-carlos-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_5, 'BAC + 5', 7))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamexpert',
            'Lamexpert ',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_19));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_3, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('yann@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Yann');
        $applicant->setLastName('Sigaud');
        $applicant->setBirthdate(new \DateTime('1988-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat moyennement motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/yann-sigaud-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::UNSPECIFIED, 'non-precise', 0))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_3));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_4, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('gisele@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Gisele');
        $applicant->setLastName('Bundchen');
        $applicant->setBirthdate(new \DateTime('1988-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat moyennement motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/gisele-bundchen-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::UNSPECIFIED, 'non-precise', 0))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_5, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('anna@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Anna');
        $applicant->setLastName('Kournikova');
        $applicant->setBirthdate(new \DateTime('1985-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat moyennement motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/anna-kournikova-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4', 6))->getId());
        $applicant->setCurrentExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_6, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('david@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('David');
        $applicant->setLastName('Beckhim');
        $applicant->setBirthdate(new \DateTime('1992-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat moyennement motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/david-beckhim-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4', 6))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_7, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('mohamed@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Mohamed');
        $applicant->setLastName('Salah');
        $applicant->setBirthdate(new \DateTime('1999-01-01'));
        $applicant->setDefaultMotivationText('Je suis un candidat moyennement motivé');
        $applicant->setLinkedin('https://www.linkedin.com/in/mohamed-salah-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_7, 'BAC + 7', 9))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_3));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_8, $applicant);
        $manager->flush();

        $applicant = new Applicant();
        $applicant->setCreatedDate(new \DateTime());
        $applicant->setLastModifiedDate(new \DateTime());
        $applicant->setActive(true);
        $applicant->setEmail('lucie@gmail.com');
        $applicant->setRoles(['ROLE_APPLICANT']);
        $applicant->setPassword($this->hasher->hashPassword($applicant, 'password'));
        $applicant->setFirstName('Lucie');
        $applicant->setLastName('Bourdeau');
        $applicant->setBirthdate(new \DateTime('1999-01-01'));
        $applicant->setDefaultMotivationText('Je suis une candidate moyennement motivée');
        $applicant->setLinkedin('https://www.linkedin.com/in/lucie-bourdeau-2b1b4b1/');
        $applicant->setCurrentLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_7, 'BAC + 7', 9))->getId());
        $applicant->setCurrentExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicant->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $applicant->setCurrentJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
        $applicant->setStatus((new ApplicantStatus(ApplicantStatus::ACTIVE, 'active'))->getId());
        $applicant->setOptin(false);

        $manager->persist($applicant);
        $this->addReference(self::APPLICANT_REFERENCE_9, $applicant);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            JobTitleFixtures::class,
        ];
    }
}
