<?php

namespace App\DataFixtures;

use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RegionFixtures extends Fixture implements DependentFixtureInterface
{
    public const REGION_REFERENCE = 'region';

    public function load(ObjectManager $manager)
    {
        $region = new Region();
        $region->setName('Pays de la Loire');
        $region->setSlug('pays-de-la-loire');
        $region->setCountry($this->getReference(CountryFixtures::COUNTRY_REFERENCE));
        $this->addReference(self::REGION_REFERENCE, $region);
        $manager->persist($region);
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            CountryFixtures::class,
        ];
    }
}