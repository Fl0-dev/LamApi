<?php

namespace App\DataFixtures;

use App\Entity\Location\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public const COUNTRY_REFERENCE = 'country';
    
    public function load(ObjectManager $manager): void
    {
        $country = new Country();
        $country->setName('France');
        $country->setSlug('france');
        $this->addReference(self::COUNTRY_REFERENCE, $country);
        $manager->persist($country);
        $manager->flush();
    }
}
