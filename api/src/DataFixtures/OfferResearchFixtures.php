<?php

namespace App\DataFixtures;

use App\Entity\Research\OfferResearch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferResearchFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offerResearch = new OfferResearch();
        $offerResearch->addCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        
        
        $manager->persist($offerResearch);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            JobTypeFixtures::class,
            ToolFixtures::class,
            BadgeFixtures::class,
        ];
    }
}