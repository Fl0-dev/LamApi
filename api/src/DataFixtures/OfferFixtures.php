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
    public const OFFER_REFERENCE_TGS_FRANCE_NANTES_1 = 'offer-tgs-nantes-1';
    public const OFFER_REFERENCE_TGS_FRANCE_NANTES_2 = 'offer-tgs-nantes-2';
    public const OFFER_REFERENCE_TGS_FRANCE_STNAZ_1 = 'offer-tgs-stnaz-1';
    public const OFFER_REFERENCE_TGS_FRANCE_STNAZ_2 = 'offer-tgs-stnaz-2';
    public const OFFER_REFERENCE_EOLIS_1 = 'offer-eolis-1';
    public const OFFER_REFERENCE_EOLIS_2 = 'offer-eolis-2';
    public const OFFER_REFERENCE_LIVLI_1 = 'offer-livli-1';
    public const OFFER_REFERENCE_LIVLI_2 = 'offer-livli-2';
    public const OFFER_REFERENCE_LIVLI_3 = 'offer-livli-3';
    public const OFFER_REFERENCE_IN_EXTENSO_CHALLANS_1 = 'offer-in-extenso-challans-1';
    public const OFFER_REFERENCE_IN_EXTENSO_CHALLANS_2 = 'offer-in-extenso-challans-2';
    public const OFFER_REFERENCE_IN_EXTENSO_LUCON_1 = 'offer-in-extenso-lucon-1';
    public const OFFER_REFERENCE_IN_EXTENSO_LUCON_2 = 'offer-in-extenso-lucon-2';

    public function load(ObjectManager $manager): void
    {
        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 1 CDI de TGS France Nantes");
        $offer->setMissions("Offre 1 de TGS France Nantes");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offer->setNeeds("Needs 1 de TGS France Nantes");
        $offer->setProspectWithUs("Prospect 1 de TGS France Nantes");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 1 de TGS France Nantes");
        $offer->setSlug("offer-1-tgs-france-nantes");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 1 de TGS France Nantes");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-1 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_TGS_FRANCE_NANTES_1, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_1)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        )
        )->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 2 CDI de TGS France Nantes");
        $offer->setMissions("Offre 2 de TGS France Nantes");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offer->setNeeds("Needs 2 de TGS France Nantes");
        $offer->setProspectWithUs("Prospect 2 de TGS France Nantes");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 2 de TGS France Nantes");
        $offer->setSlug("offer-2-tgs-france-nantes");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 2 de TGS France Nantes");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-1 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_TGS_FRANCE_NANTES_2, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_2)
        );
        $offer->setContractType((new ContractType(ContractType::CDD, 'CDD'))->getId());
        $offer->setExperience(
            (new Experience(
                'lamajunior',
                'Lamajunior',
                1,
                'Lamajunior (- 1 an)',
                "< 1 an d'expérience",
                0
            ))->getId()
        );
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'BAC + 2'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 1 CDD de de TGS France St Nazaire");
        $offer->setMissions("Offre 1 de TGS France St Nazaire");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offer->setNeeds("Needs 1 de TGS France St Nazaire");
        $offer->setProspectWithUs("Prospect 1 de TGS France St Nazaire");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 1 de TGS France St Nazaire");
        $offer->setSlug("offer-1-tgs-france-st-nazaire");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 1 de TGS France St Nazaire");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-1 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $this->addReference(self::OFFER_REFERENCE_TGS_FRANCE_STNAZ_1, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_2)
        );
        $offer->setContractType((new ContractType(ContractType::CDD, 'CDD'))->getId());
        $offer->setExperience(
            (new Experience(
                'lamajunior',
                'Lamajunior',
                1,
                'Lamajunior (- 1 an)',
                "< 1 an d'expérience",
                0
            ))->getId()
        );
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_2, 'BAC + 2'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 2 CDD de de TGS France St Nazaire");
        $offer->setMissions("Offre 2 de TGS France St Nazaire");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_16));
        $offer->setNeeds("Needs 2 de TGS France St Nazaire");
        $offer->setProspectWithUs("Prospect 2 de TGS France St Nazaire");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 2 de TGS France St Nazaire");
        $offer->setSlug("offer-2-tgs-france-st-nazaire");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 2 de TGS France St Nazaire");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-1 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $this->addReference(self::OFFER_REFERENCE_TGS_FRANCE_STNAZ_2, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'lamasenior',
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 1 CDI de Eolis Nantes");
        $offer->setMissions("Offre 1 de Eolis Nantes");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
        $offer->setNeeds("Needs 1 de Eolis Nantes");
        $offer->setProspectWithUs("Prospect 1 de Eolis Nantes");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 1 de Eolis Nantes");
        $offer->setSlug("offer-1-eolis-nantes");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 1 de Eolis Nantes");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-2 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_EOLIS_1, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_3)
        );
        $offer->setContractType((new ContractType(ContractType::INTERNSHIP, 'Stage'))->getId());
        $offer->setExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::UNSPECIFIED, 'Non précisé'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 2 stage de Eolis Nantes");
        $offer->setMissions("Offre 2 de Eolis Nantes");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_6));
        $offer->setNeeds("Needs 2 de Eolis Nantes");
        $offer->setProspectWithUs("Prospect 2 de Eolis Nantes");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 2 de Eolis Nantes");
        $offer->setSlug("offer-2-eolis-nantes");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 2 de Eolis Nantes");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-2 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_EOLIS_2, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 1 CDI de Livli");
        $offer->setMissions("Offre 1 de Livli");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offer->setNeeds("Needs 1 de Livli");
        $offer->setProspectWithUs("Prospect 1 de Livli");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 1 de Livli");
        $offer->setSlug("offer-1-livli");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 1 de Livli");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-3 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_LIVLI_1, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $offer->setContractType((new ContractType(ContractType::CDD, 'CDD'))->getId());
        $offer->setExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 2 CDD de Livli");
        $offer->setMissions("Offre 2 de Livli");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offer->setNeeds("Needs 2 de Livli");
        $offer->setProspectWithUs("Prospect 2 de Livli");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 2 de Livli");
        $offer->setSlug("offer-2-livli");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 2 de Livli");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-3 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $this->addReference(self::OFFER_REFERENCE_LIVLI_2, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_4)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'non-precise',
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_4, 'BAC + 4'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 3 CDI de Livli");
        $offer->setMissions("Offre 3 de Livli");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_9));
        $offer->setNeeds("Needs 3 de Livli");
        $offer->setProspectWithUs("Prospect 3 de Livli");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 3 de Livli");
        $offer->setSlug("offer-3-livli");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 3 de Livli");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-3 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_3));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_8));
        $this->addReference(self::OFFER_REFERENCE_LIVLI_3, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'lamexpert',
            'Lamexpert ',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_8, 'BAC + 8'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 1 de In Extenso Challans");
        $offer->setMissions("Offre 1 de In Extenso Challans");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
        $offer->setNeeds("Needs 1 de In Extenso Challans");
        $offer->setProspectWithUs("Prospect 1 de In Extenso Challans");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 1 de In Extenso Challans");
        $offer->setSlug("offer-1-in-extenso-challans");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 1 de In Extenso Challans");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-5 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_IN_EXTENSO_CHALLANS_1, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_5)
        );
        $offer->setContractType((new ContractType(ContractType::CDI, 'CDI'))->getId());
        $offer->setExperience((new Experience(
            'lamexpert',
            'Lamexpert ',
            4,
            'Lamexpert (+ 5 ans)',
            "+ de 5 ans d'expérience",
            60
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC_8, 'BAC + 8'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 2 de In Extenso Challans");
        $offer->setMissions("Offre 2 de In Extenso Challans");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_21));
        $offer->setNeeds("Needs 2 de In Extenso Challans");
        $offer->setProspectWithUs("Prospect 2 de In Extenso Challans");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 2 de In Extenso Challans");
        $offer->setSlug("offer-2-in-extenso-challans");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 2 de In Extenso Challans");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-5 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_IN_EXTENSO_CHALLANS_2, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $offer->setContractType((new ContractType(ContractType::ALTERNANCE, 'Alternance'))->getId());
        $offer->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC, 'BAC'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 1 alternance de In Extenso Luçon");
        $offer->setMissions("Offre 1 de In Extenso Luçon");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
        $offer->setNeeds("Needs 1 de In Extenso Luçon");
        $offer->setProspectWithUs("Prospect 1 de In Extenso Luçon");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 1 de In Extenso Luçon");
        $offer->setSlug("offer-1-in-extenso-lucon");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 1 de In Extenso Luçon");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-5 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_IN_EXTENSO_LUCON_1, $offer);
        $manager->persist($offer);

        $offer = new Offer();
        $offer->setCompanyEntityOffice(
            $this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_OFFICE_REFERENCE_6)
        );
        $offer->setContractType((new ContractType(ContractType::ALTERNANCE, 'Alternance'))->getId());
        $offer->setExperience((new Experience(
            'lamajunior',
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());
        $offer->setLevelOfStudy((new LevelOfStudy(LevelOfStudy::BAC, 'BAC'))->getId());
        $offer->setCreatedDate(new \DateTime());
        $offer->setLastModifiedDate(new \DateTime());
        $offer->setTitle("Offre 2 alternance de In Extenso Luçon");
        $offer->setMissions("Offre 2 de In Extenso Luçon");
        $offer->setFullyTelework(true);
        $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_5));
        $offer->setNeeds("Needs 2 de In Extenso Luçon");
        $offer->setProspectWithUs("Prospect 2 de In Extenso Luçon");
        $offer->setProvided(false);
        $offer->setRecruitmentProcess("Recruitment Process 2 de In Extenso Luçon");
        $offer->setSlug("offer-2-in-extenso-lucon");
        $offer->setStatus((new OfferStatus(OfferStatus::PUBLISHED, 'Published'))->getId());
        $offer->setWorkWithUs("Work with us 2 de In Extenso Luçon");
        $offer->setWeeklyHours(35.5);
        $offer->setStartASAP(true);
        $offer->setPublishedAt(new \DateTime('-5 day'));
        $offer->setAuthor($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_1));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_2));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_4));
        $offer->addUserJobBoard($this->getReference(JobBoardFixtures::JOB_BOARD_REFERENCE_6));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $offer->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $this->addReference(self::OFFER_REFERENCE_IN_EXTENSO_LUCON_2, $offer);
        $manager->persist($offer);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ToolFixtures::class,
            EmployerFixtures::class,
            ApplicantFixtures::class,
            ApplicantCvFixtures::class,
            AtsFixtures::class,
            JobBoardFixtures::class,
            JobTitleFixtures::class,
            CompanyGroupFixtures::class,
        ];
    }
}
