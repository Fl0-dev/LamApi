<?php

namespace App\DataFixtures;

use App\Entity\ApplicantCv;
use App\Entity\Application;
use App\Entity\Offer;
use App\Entity\Repositories\ApplicationStatus;
use App\Entity\Repositories\ContractType;
use App\Entity\Repositories\Experience;
use App\Entity\Repositories\LevelOfStudy;
use App\Entity\Repositories\OfferStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_1));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::SENIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDI de TGS France");
            $offer->setMissions("Offre $i de TGS France");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_7));
            $offer->setNeeds("Needs $i de TGS France");
            $offer->setProspectWithUs("Prospect $i de TGS France");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de TGS France");
            $offer->setSlug("offer-$i-tgs-france");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de TGS France");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-1 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_1));

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_1));
            $offer->setContractType(ContractType::CDD);
            $offer->setExperience(Experience::JUNIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_2);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDD de de TGS France");
            $offer->setMissions("Offre $i de TGS France");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_7));
            $offer->setNeeds("Needs $i de TGS France");
            $offer->setProspectWithUs("Prospect $i de TGS France");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de TGS France");
            $offer->setSlug("offer-$i-tgs-france");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de TGS France");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-1 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_1));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_1));


            $manager->persist($offer);
        }

        for ($i = 0; $i < 4; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::SENIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDI de Eolis Nantes");
            $offer->setMissions("Offre $i de Eolis Nantes");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_6));
            $offer->setNeeds("Needs $i de Eolis Nantes");
            $offer->setProspectWithUs("Prospect $i de Eolis Nantes");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de Eolis Nantes");
            $offer->setSlug("offer-$i-eolis-nantes");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de Eolis Nantes");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-2 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_4));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));
            $offer->setContractType(ContractType::INTERNSHIP);
            $offer->setExperience(Experience::UNSPECIFIED);
            $offer->setLevelOfStudy(LevelOfStudy::UNSPECIFIED);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i stage de Eolis Nantes");
            $offer->setMissions("Offre $i de Eolis Nantes");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_6));
            $offer->setNeeds("Needs $i de Eolis Nantes");
            $offer->setProspectWithUs("Prospect $i de Eolis Nantes");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de Eolis Nantes");
            $offer->setSlug("offer-$i-eolis-nantes");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de Eolis Nantes");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-2 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::UNSPECIFIED);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDI de Livli");
            $offer->setMissions("Offre $i de Livli");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_4));
            $offer->setNeeds("Needs $i de Livli");
            $offer->setProspectWithUs("Prospect $i de Livli");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de Livli");
            $offer->setSlug("offer-$i-livli");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de Livli");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-3 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_5));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_6));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));
            $offer->setContractType(ContractType::CDD);
            $offer->setExperience(Experience::UNSPECIFIED);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDD de Livli");
            $offer->setMissions("Offre $i de Livli");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_4));
            $offer->setNeeds("Needs $i de Livli");
            $offer->setProspectWithUs("Prospect $i de Livli");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de Livli");
            $offer->setSlug("offer-$i-livli");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de Livli");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-3 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_8));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));

            $manager->persist($offer);
        }


        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::EXPERT);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_8);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i de In Extenso");
            $offer->setMissions("Offre $i de In Extenso");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_6));
            $offer->setNeeds("Needs $i de In Extenso");
            $offer->setProspectWithUs("Prospect $i de In Extenso");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de In Extenso");
            $offer->setSlug("offer-$i-in-extenso");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de In Extenso");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-5 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_6));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));
            $offer->setContractType(ContractType::ALTERNANCE);
            $offer->setExperience(Experience::JUNIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i alternance de In Extenso");
            $offer->setMissions("Offre $i de In Extenso");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
            $offer->setAts($this->getReference(AtsFixtures::ATS_REFERENCE_6));
            $offer->setNeeds("Needs $i de In Extenso");
            $offer->setProspectWithUs("Prospect $i de In Extenso");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de In Extenso");
            $offer->setSlug("offer-$i-in-extenso");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de In Extenso");
            $offer->setWeeklyHours(35.5);
            $offer->setStartASAP(true);
            $offer->setPublishedAt(new \DateTime('-5 day'));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
            $offer->addJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_8));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation('Je suis motivé pour cette offre');
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_9));
            $application->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));
            $manager->persist($offer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ApplicantCvFixtures::class,
            AtsFixtures::class,
            JobBoardFixtures::class,
            JobTitleFixtures::class,
            CompanyGroupFixtures::class,
        ];
    }
}
