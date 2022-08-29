<?php

namespace App\DataFixtures;

use App\Entity\Application\Application;
use App\Entity\Offer\Offer;
use App\Entity\References\ApplicationStatus;
use App\Entity\References\ContractType;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Entity\References\OfferStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::SENIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDI de TGS France Nantes");
            $offer->setMissions("Offre $i de TGS France Nantes");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
            $offer->setNeeds("Needs $i de TGS France Nantes");
            $offer->setProspectWithUs("Prospect $i de TGS France Nantes");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de TGS France Nantes");
            $offer->setSlug("offer-$i-tgs-france-nantes");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de TGS France Nantes");
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
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de TGS France Nantes");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1));
            $application->setOffer($offer);
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_2));
            $offer->setContractType(ContractType::CDD);
            $offer->setExperience(Experience::JUNIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_2);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDD de de TGS France St Nazaire");
            $offer->setMissions("Offre $i de TGS France St Nazaire");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
            $offer->setNeeds("Needs $i de TGS France St Nazaire");
            $offer->setProspectWithUs("Prospect $i de TGS France St Nazaire");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de TGS France St Nazaire");
            $offer->setSlug("offer-$i-tgs-france-st-nazaire");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de TGS France St Nazaire");
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
            $application->setMotivation("Je suis motivé pour cette offre $i CDD de de TGS France St Nazaire");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i CDD de de TGS France St Nazaire");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1));
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }

        for ($i = 0; $i < 4; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::SENIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDI de Eolis Nantes");
            $offer->setMissions("Offre $i de Eolis Nantes");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
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
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Eolis Nantes");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Eolis Nantes");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_4));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $offer->setContractType(ContractType::INTERNSHIP);
            $offer->setExperience(Experience::UNSPECIFIED);
            $offer->setLevelOfStudy(LevelOfStudy::UNSPECIFIED);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i stage de Eolis Nantes");
            $offer->setMissions("Offre $i de Eolis Nantes");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
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
            $application->setMotivation("Je suis motivé pour cette offre $i stage de Eolis Nantes");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i stage de Eolis Nantes");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i stage de Eolis Nantes");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3));
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::UNSPECIFIED);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDI de Livli");
            $offer->setMissions("Offre $i de Livli");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
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
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Livli");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Livli");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_5));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Livli");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_6));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $offer->setContractType(ContractType::CDD);
            $offer->setExperience(Experience::UNSPECIFIED);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_4);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i CDD de Livli");
            $offer->setMissions("Offre $i de Livli");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
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
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Livli");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i CDI de Livli");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_8));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4));
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }


        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5));
            $offer->setContractType(ContractType::CDI);
            $offer->setExperience(Experience::EXPERT);
            $offer->setLevelOfStudy(LevelOfStudy::BAC_8);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i de In Extenso Challans");
            $offer->setMissions("Offre $i de In Extenso Challans");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
            $offer->setNeeds("Needs $i de In Extenso Challans");
            $offer->setProspectWithUs("Prospect $i de In Extenso Challans");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de In Extenso Challans");
            $offer->setSlug("offer-$i-in-extenso-challans");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de In Extenso Challans");
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
            $application->setMotivation("Je suis motivé pour cette offre $i de In Extenso Challans");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_6));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i de In Extenso Challans");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5));
            $application->setOffer($offer);
            $manager->persist($application);

            $manager->persist($offer);
        }

        for ($i = 0; $i < 2; $i++) {
            $offer = new Offer();
            $offer->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6));
            $offer->setContractType(ContractType::ALTERNANCE);
            $offer->setExperience(Experience::JUNIOR);
            $offer->setLevelOfStudy(LevelOfStudy::BAC);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i alternance de In Extenso Luçon");
            $offer->setMissions("Offre $i de In Extenso Luçon");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
            $offer->setNeeds("Needs $i de In Extenso Luçon");
            $offer->setProspectWithUs("Prospect $i de In Extenso Luçon");
            $offer->setProvided(false);
            $offer->setRecruitmentProcess("Recruitment Process $i de In Extenso Luçon");
            $offer->setSlug("offer-$i-in-extenso-lucon");
            $offer->setStatus(OfferStatus::PUBLISHED);
            $offer->setWorkWithUs("Work with us $i de In Extenso Luçon");
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
            $application->setMotivation("Je suis motivé pour cette offre $i de In Extenso Luçon");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i de In Extenso Luçon");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_8));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6));
            $application->setOffer($offer);
            $manager->persist($application);

            $application = new Application();
            $application->setCreatedDate(new \DateTime('now'));
            $application->setLastModifiedDate(new \DateTime('now'));
            $application->setMotivation("Je suis motivé pour cette offre $i de In Extenso Luçon");
            $application->setScore(10);
            $application->setStatus(ApplicationStatus::NEW);
            $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_9));
            $application->setCompanyEntityOffice($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6));
            $application->setOffer($offer);
            $manager->persist($application);

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
