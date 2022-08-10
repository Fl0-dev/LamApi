<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use App\Entity\Repositories\ContractType;
use App\Entity\Repositories\OfferStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++){
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_1));
            $offer->setContractType(ContractType::CDI);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i de TGS France");
            $offer->setMissions("Offre $i de TGS France");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
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
            $manager->persist($offer);
            
        }
        
        for ($i = 0; $i < 4; $i++){
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_2));
            $offer->setContractType(ContractType::CDI);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i de Eolis Nantes");
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
            $manager->persist($offer);
        }

        for ($i = 0; $i < 4; $i++){
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_3));
            $offer->setContractType(ContractType::CDI);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i de Livli");
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
            $manager->persist($offer);
        }

        for ($i = 0; $i < 4; $i++){
            $offer = new Offer();
            $offer->setCompanyEntity($this->getReference(CompanyGroupFixtures::COMPANY_ENTITY_REFERENCE_4));
            $offer->setContractType(ContractType::CDI);
            $offer->setCreatedDate(new \DateTime());
            $offer->setLastModifiedDate(new \DateTime());
            $offer->setTitle("Offre $i de In Extenso");
            $offer->setMissions("Offre $i de In Extenso");
            $offer->setFullyTelework(true);
            $offer->setJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_10));
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
            $manager->persist($offer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            JobTitleFixtures::class,
            CompanyGroupFixtures::class,
        ];
    }

}