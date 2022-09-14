<?php

namespace App\DataFixtures;

use App\Entity\References\Experience;
use App\Entity\Research\OfferResearch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferResearchFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_1));
        $offerResearch->addDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $offerResearch->setNbResult(10);

        $manager->persist($offerResearch);
        $manager->flush();

        $offerResearch = new OfferResearch();
        $offerResearch->setCreatedDate(new \Datetime());
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $offerResearch->addJobTitle($this->getReference(JobTitleFixtures::JOB_TITLE_REFERENCE_2));
        $offerResearch->addExperience((new Experience(Experience::SENIOR, 'Lamasenior', 'Lamasenior (2 à 5 ans)', "de 2 à 5 ans d'expérience",24))->getId());
        $offerResearch->addExperience((new Experience(Experience::JUNIOR, 'Lamajunior', 'Lamajunior (- 1 an)', "< 1 an d'expérience",0))->getId());
        $offerResearch->setNbResult(10);

        $manager->persist($offerResearch);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            DepartmentFixtures::class,
            JobTitleFixtures::class,
            ToolFixtures::class,
            BadgeFixtures::class,
        ];
    }
}