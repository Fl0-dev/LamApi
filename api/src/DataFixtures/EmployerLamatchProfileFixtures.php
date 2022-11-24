<?php

namespace App\DataFixtures;

use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchProfile;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployerLamatchProfileFixtures extends Fixture implements DependentFixtureInterface
{
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_1 = 'avocat-social-office-1-rouge-employer-1';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_2 = 'fiscalite-office-1-rouge-employer-1';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_3 = 'fiscalite-office-2-rouge-employer-1';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_4 = 'expert-comptable-office-2-bleu-employer-1';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_5 = 'avocat-social-office-1-rouge-employer-2';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_6 = 'expert-comptable-office-2-rouge-employer-2';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_7 = 'consultant-junior-office-10-vert-employer-3';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_8 = 'consultant-junior-office-10-jaune-employer-3';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_9 = 'consultant-junior-junior-office-10-jaune-employer-3';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_10 = 'expert-comptable-office-3-jaune-employer-4';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_11 = 'juriste-societe-office-3-jaune-employer-4';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_12 = 'dev-office-3-vert-employer-5';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_13 = 'expert-comptable-office-4-vert-employer-5';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_14 = 'expert-comptable-office-5-rouge-employer-6';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_15 = 'pilote-office-6-rouge-employer-6';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_16 = 'expert-comptable-office-6-rouge-employer-7';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_17 = 'expert-comptable-office-7-rouge-employer-8';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_18 = 'expert-comptable-office-8-vert-employer-8';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_19 = 'expert-comptable-office-9-vert-employer-9';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_20 = 'manager-audit-office-9-vert-employer-9';
    public const EMPLOYER_LAMATCH_PROFILE_REFERENCE_21 = 'expert-comptable-office-6-rouge-employer-6';

    public function load(ObjectManager $manager): void
    {
        //Employer 1 (TGS France)
        //profile1 for office1
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_2)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'Bac + 2'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_8));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Avocat social office 1 rouge employer 1');
        $employerLamatchProfile->setSlug('avocat-social-office-1-rouge-employer-1');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_1, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile2 for office1
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_2)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'Bac + 4'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_21));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Fiscalité office 1 rouge employer 1');
        $employerLamatchProfile->setSlug('fiscalite-office-1-rouge-employer-1');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_2, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office2
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_2)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_2)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC, 'Bac'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_21));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Fiscalité office 2 rouge employer 1');
        $employerLamatchProfile->setSlug('fiscalite-office-2-rouge-employer-1');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_3, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office10
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_3)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_10)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_5, 'Bac + 5'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamexpert',
            'Lamexpert',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_CONSCIENTIOUS));
        $employerLamatchProfile->setLabel('Expert Comptable office 2 bleu employer 1');
        $employerLamatchProfile->setSlug('expert-comptable-office-2-bleu-employer-1');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_4, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 2 (TGS FranceOuest)
        //profile for office1
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_2)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_2)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'Bac + 2'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_8));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Avocat social office 1 rouge employer 2');
        $employerLamatchProfile->setSlug('avocat-social-office-1-rouge-employer-2');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_5, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office2
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_2)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_2)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_2)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_3, 'Bac + 3'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Expert-comptable office 2 rouge employer 2');
        $employerLamatchProfile->setSlug('expert-comptable-office-2-rouge-employer-2');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_6, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 3 (TGS FranceEst)
        //profile for office10
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_3)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_10)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_3)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_3, 'Bac + 3'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_15));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_STEADY));
        $employerLamatchProfile->setLabel('Consultant Junior office 10 vert employer 3');
        $employerLamatchProfile->setSlug('consultant-junior-office-10-vert-employer-3');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_7, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office10
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_3)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_10)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_3)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_3, 'Bac + 3'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_15));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_INFLUENTIAL));
        $employerLamatchProfile->setLabel('Consultant Junior office 10 jaune employer 3');
        $employerLamatchProfile->setSlug('consultant-junior-office-10-jaune-employer-3');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_8, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office10
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_3)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_10)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_3)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC, 'Bac'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_15));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_INFLUENTIAL));
        $employerLamatchProfile->setLabel('Consultant Junior junior office 10 jaune employer 3');
        $employerLamatchProfile->setSlug('consultant-junior-junior-office-10-jaune-employer-3');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_9, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 4 (Eolis)
        //profile for office3
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_4)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_4)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC, 'Bac'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_15));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_INFLUENTIAL));
        $employerLamatchProfile->setLabel('Expert comptable office 3 jaune employer 4');
        $employerLamatchProfile->setSlug('expert-comptable-office-3-jaune-employer-4');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_10, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office3
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_4)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_4)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'Bac + 4'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamexpert',
            'Lamexpert',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_25));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_INFLUENTIAL));
        $employerLamatchProfile->setLabel('juriste société office 3 jaune employer 4');
        $employerLamatchProfile->setSlug('juriste-societe-office-3-jaune-employer-4');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_11, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 5 (Livli)
        //profile for office4
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_5)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_5)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'Bac + 4'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamexpert',
            'Lamexpert',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_29));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_STEADY));
        $employerLamatchProfile->setLabel('Dev office 4 vert employer 5');
        $employerLamatchProfile->setSlug('dev-office-3-vert-employer-5');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_12, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office4
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_5)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_5)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_1, 'Bac + 1'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_STEADY));
        $employerLamatchProfile->setLabel('Expert comptable office 4 vert employer 5');
        $employerLamatchProfile->setSlug('expert-comptable-office-4-vert-employer-5');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_13, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 6 (InExtensoOuest)
        //profile for office5
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_7)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_6)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_1, 'Bac + 1'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Expert comptable office 5 rouge employer 6');
        $employerLamatchProfile->setSlug('expert-comptable-office-5-rouge-employer-6');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_14, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office6
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_7)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_6)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_1, 'Bac + 1'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Expert comptable office 6 rouge employer 6');
        $employerLamatchProfile->setSlug('expert-comptable-office-6-rouge-employer-6');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_21, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office6
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_7)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_6)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'Bac + 2'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_22));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Pilote office 6 rouge employer 6');
        $employerLamatchProfile->setSlug('pilote-office-6-rouge-employer-6');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_15, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 7 (InExtensoOuest)
        //profile for office6
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_7)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_7)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_1, 'Bac + 1'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Expert comptable office 6 rouge employer 7');
        $employerLamatchProfile->setSlug('expert-comptable-office-6-rouge-employer-7');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_16, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 8 (InExtensoMetz)
        //profile for office7
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_8)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_7)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_8)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'Bac + 2'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_DOMINANT));
        $employerLamatchProfile->setLabel('Expert comptable office 7 rouge employer 8');
        $employerLamatchProfile->setSlug('expert-comptable-office-7-rouge-employer-8');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_17, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office8
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_8)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_8)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_8)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'Bac + 2'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_STEADY));
        $employerLamatchProfile->setLabel('Expert comptable office 8 vert employer 8');
        $employerLamatchProfile->setSlug('expert-comptable-office-8-vert-employer-8');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_18, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //Employer 9 (InExtensoChallons)
        //profile for office9
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_9)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_9)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_9)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'Bac + 2'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamaffirmé',
            'Lamaffirmé',
            2,
            'Lamaffirmé (1 à 2 ans)',
            "de 1 à 2 ans d'expérience",
            12
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_20));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_STEADY));
        $employerLamatchProfile->setLabel('Expert comptable office 9 vert employer 9');
        $employerLamatchProfile->setSlug('expert-comptable-office-9-vert-employer-9');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_19, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();

        //profile for office9
        $employerLamatchProfile = new EmployerLamatchProfile();
        $employerLamatchProfile->setCreatedDate(new \DateTime());
        $employerLamatchProfile->setLastModifiedDate(new \DateTime());
        $employerLamatchProfile->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $employerLamatchProfile->setCompanyProfile(
            $this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_9)
        );
        $employerLamatchProfile->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_9)
        );
        $employerLamatchProfile->setEmployerLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_9)
        );
        $employerLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_6, 'Bac + 6'))->getId());
        $employerLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $employerLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_27));
        $employerLamatchProfile->setPersonality($this->getReference(DISCFixtures::DISC_PERSONALITY_STEADY));
        $employerLamatchProfile->setLabel('Manager audit office 9 vert employer 9');
        $employerLamatchProfile->setSlug('manager-audit-office-9-vert-employer-9');

        $this->addReference(self::EMPLOYER_LAMATCH_PROFILE_REFERENCE_20, $employerLamatchProfile);
        $manager->persist($employerLamatchProfile);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            DISCFixtures::class,
            CompanyProfileFixtures::class,
            JobTitleFixtures::class,
            CompanyGroupFixtures::class,
            EmployerLamatchSubscriptionFixtures::class,
        ];
    }
}
