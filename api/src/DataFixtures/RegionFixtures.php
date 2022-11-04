<?php

namespace App\DataFixtures;

use App\Entity\Location\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RegionFixtures extends Fixture implements DependentFixtureInterface
{
    public const REGION_REFERENCE_1 = 'region-1';
    public const REGION_REFERENCE_2 = 'region-2';

    public function load(ObjectManager $manager): void
    {
        $region = new Region();
        $region->setName('Pays de la Loire');
        $region->setSlug('pays-de-la-loire');
        $region->setCountry($this->getReference(CountryFixtures::COUNTRY_REFERENCE));
        $this->addReference(self::REGION_REFERENCE_1, $region);
        $manager->persist($region);
        $manager->flush();

        $region = new Region();
        $region->setName('Grand Est');
        $region->setSlug('grand-est');
        $region->setCountry($this->getReference(CountryFixtures::COUNTRY_REFERENCE));
        $this->addReference(self::REGION_REFERENCE_2, $region);
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
