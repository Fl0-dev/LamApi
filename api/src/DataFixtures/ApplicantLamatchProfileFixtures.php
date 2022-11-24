<?php

namespace App\DataFixtures;

use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Entity\References\Workforce;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicantLamatchProfileFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // ApplicantLamatchProfile for Applicant 1
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_1));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Jean-eudes et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_7, 'BAC + 7'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_2, '10 à 19 salariés', 2))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INFORMATIQUE)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_1)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_2)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_3)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_1)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_3));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_4));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 2
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Estelle et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'BAC + 2'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_3, '20 à 49 salariés', 3))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_4));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_5));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INFORMATIQUE)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_5)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_2)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_3)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_2)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_3));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_4));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 3
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_3));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Esteban et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_5, 'BAC + 5'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'lamexpert',
            'Lamexpert ',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_19));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_4, '50 à 99 salariés', 4))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_7));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_4));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_9));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AGRICOLE)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AGROALIMENTAIRE)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_1)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_2)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_5)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_7)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_3)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_4));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_5));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 4
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_4));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Yann et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy(
            (new LevelOfStudy(LevelOfStudy::UNSPECIFIED, 'non-precise'))->getId()
        );
        $applicantLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_1, '1 à 9 salariés', 1))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_5));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_7));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_8));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BANQUE)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_FINANCE)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_5)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_2)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_6)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_4)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_3));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_1));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 5
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_5));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Gisele et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy(
            (new LevelOfStudy(LevelOfStudy::UNSPECIFIED, 'non-precise'))->getId()
        );
        $applicantLamatchProfile->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_1, '1 à 9 salariés', 1))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_4));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_5));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_6));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BTP)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_5)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_3));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_5));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 6
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_6));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Anna et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_1, '1 à 9 salariés', 1))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_9));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_10));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_DISTRIBUTION)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_DISTRIBUTION)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_1)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_2)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_3)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_9)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_6)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_3));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 7
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_7));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis David et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_4));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_6));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_8));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_EDUCATION)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_3)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_6)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_9)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_7)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_2));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 8
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_8));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Mohamed et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_7, 'BAC + 7'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_5));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AUTRE)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_5)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_6)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_7)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_8)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_8)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_4));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_1));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();

        // ApplicantLamatchProfile for Applicant 9
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_9));
        $applicantLamatchProfile->setCreatedDate(new \DateTime());
        $applicantLamatchProfile->setLastModifiedDate(new \DateTime());
        $applicantLamatchProfile->setIntroduction('Je suis Lucie et je le vaux bien');
        $applicantLamatchProfile->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_7, 'BAC + 7'))->getId());
        $applicantLamatchProfile->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $applicantLamatchProfile->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
        $applicantLamatchProfile->setDesiredWorkforce(
            (new Workforce(Workforce::LEVEL_8, '1000 à 1999 salariés', 8))->getId()
        );
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_4));
        $applicantLamatchProfile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_5));
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AUTOMOBILE)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_MEDIAS)
        );
        $applicantLamatchProfile->addDesiredExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_COMMUNICATION)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_3)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_5)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_7)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_8)
        );
        $applicantLamatchProfile->addDesiredBadge(
            $this->getReference(BadgeFixtures::BADGE_REFERENCE_9)
        );
        $applicantLamatchProfile->setDesiredLocation(
            $this->getReference(DesiredLocationFixtures::DESIRED_LOCATION_REFERENCE_9)
        );
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_STEADY_1));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_2));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_INFLUENTIAL_5));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_DOMINANT_5));
        $applicantLamatchProfile->addQuality($this->getReference(DISCFixtures::DISC_QUALITY_CONSCIENTIOUS_4));
        $manager->persist($applicantLamatchProfile);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DISCFixtures::class,
            ExpertiseFieldFixtures::class,
            DesiredLocationFixtures::class,
            BadgeFixtures::class,
            ToolFixtures::class,
            ApplicantFixtures::class,
            JobTitleFixtures::class,
        ];
    }
}
