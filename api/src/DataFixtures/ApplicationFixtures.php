<?php

namespace App\DataFixtures;

use App\Entity\Application\Application;
use App\Entity\References\ApplicationStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDI de TGS France Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_1));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_NANTES_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDI de TGS France Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_NANTES_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 CDI de TGS France Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_1));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_NANTES_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 CDI de TGS France Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_NANTES_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDD de de TGS France St Nazaire");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_1));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_1));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_STNAZ_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDD de de TGS France St Nazaire");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_STNAZ_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 CDD de de TGS France St Nazaire");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_3));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_STNAZ_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 CDD de de TGS France St Nazaire");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_TGS_FRANCE_STNAZ_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDI de Eolis Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_3));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_EOLIS_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDI de Eolis Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_4));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_4));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_EOLIS_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 stage de Eolis Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_EOLIS_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 stage de Eolis Nantes");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_3));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_3));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_EOLIS_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDI de Livli");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_2));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_LIVLI_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 CDI de Livli");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_5));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_5));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_LIVLI_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 CDD de Livli");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_6));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_6));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_LIVLI_2));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 de In Extenso Challans");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_6));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_6));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_IN_EXTENSO_CHALLANS_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 de In Extenso Challans");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_7));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_7));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_IN_EXTENSO_CHALLANS_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 1 de In Extenso Luçon");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_8));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_8));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_IN_EXTENSO_LUCON_1));
        $manager->persist($application);

        $application = new Application();
        $application->setCreatedDate(new \DateTime('now'));
        $application->setLastModifiedDate(new \DateTime('now'));
        $application->setMotivationText("Je suis motivé pour cette offre 2 de In Extenso Luçon");
        $application->setScore(10);
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setCv($this->getReference(ApplicantCvFixtures::APPLICANT_CV_REFERENCE_9));
        $application->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_9));
        $application->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $application->setOffer($this->getReference(OfferFixtures::OFFER_REFERENCE_IN_EXTENSO_LUCON_2));
        $manager->persist($application);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CompanyGroupFixtures::class,
            OfferFixtures::class,
            ApplicantCvFixtures::class,
            ApplicantFixtures::class,
        ];
    }
}
