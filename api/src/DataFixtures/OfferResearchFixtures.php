<?php

namespace App\DataFixtures;

use App\Entity\OfferSubscription\OfferResearch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferResearchFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offerResearch = new OfferResearch();
        
        
        $manager->persist($offerResearch);
        $manager->flush();
    }

    public function getDependencies()
    {}
}