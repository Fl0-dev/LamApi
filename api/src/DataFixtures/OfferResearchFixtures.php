<?php

namespace App\DataFixtures;

use App\Entity\References\Experience;
use App\Entity\Research\OfferResearch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferResearchFixtures extends Fixture implements DependentFixtureInterface
{
    public const OFFER_RESEARCH_REFERENCE_1 = 'offer-research-1';
    public const OFFER_RESEARCH_REFERENCE_2 = 'offer-research-2';
    public const OFFER_RESEARCH_REFERENCE_3 = 'offer-research-3';
    public const OFFER_RESEARCH_REFERENCE_4 = 'offer-research-4';
    public const OFFER_RESEARCH_REFERENCE_5 = 'offer-research-5';

    public function load(ObjectManager $manager): void
    {
        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_1));
        $offerResearch->addDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));

        $manager->persist($offerResearch);
        $manager->flush();

        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offerResearch->addExperience((new Experience(
            Experience::SENIOR,
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());
        $offerResearch->addExperience((new Experience(
            Experience::JUNIOR,
            'Lamajunior',
            1,
            'Lamajunior (- 1 an)',
            "< 1 an d'expérience",
            0
        ))->getId());

        $this->addReference(self::OFFER_RESEARCH_REFERENCE_1, $offerResearch);
        $manager->persist($offerResearch);
        $manager->flush();

        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_1));
        $offerResearch->addDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));

        $this->addReference(self::OFFER_RESEARCH_REFERENCE_2, $offerResearch);
        $manager->persist($offerResearch);
        $manager->flush();

        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_4));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_15));
        $offerResearch->addExperience((new Experience(
            Experience::UNSPECIFIED,
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());

        $this->addReference(self::OFFER_RESEARCH_REFERENCE_3, $offerResearch);
        $manager->persist($offerResearch);
        $manager->flush();

        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_4));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_15));
        $offerResearch->addExperience((new Experience(
            Experience::UNSPECIFIED,
            'Non précisé',
            0,
            'Non précisé',
            "Non précisé",
            0
        ))->getId());

        $this->addReference(self::OFFER_RESEARCH_REFERENCE_4, $offerResearch);
        $manager->persist($offerResearch);
        $manager->flush();

        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_13));
        $offerResearch->addExperience((new Experience(
            Experience::SENIOR,
            'Lamasenior',
            3,
            'Lamasenior (2 à 5 ans)',
            "de 2 à 5 ans d'expérience",
            24
        ))->getId());

        $this->addReference(self::OFFER_RESEARCH_REFERENCE_5, $offerResearch);
        $manager->persist($offerResearch);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            DepartmentFixtures::class,
            JobTitleFixtures::class,
        ];
    }
}
