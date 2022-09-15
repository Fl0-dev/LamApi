<?php

namespace App\DataFixtures;

use App\Entity\Location\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture implements DependentFixtureInterface
{
    public const CITY_REFERENCE_1 = 'city1';
    public const CITY_REFERENCE_2 = 'city2';
    public const CITY_REFERENCE_3 = 'city3';
    public const CITY_REFERENCE_4 = 'city4';

    public function load(ObjectManager $manager)
    {
        $city = new City();
        $city->setName('Nantes');
        $city->setSlug('nantes');
        $city->setDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $this->addReference(self::CITY_REFERENCE_1, $city);
        $manager->persist($city);
        $manager->flush();

        $city = new City();
        $city->setName('Saint-Nazaire');
        $city->setSlug('saint-nazaire');
        $city->setDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $this->addReference(self::CITY_REFERENCE_2, $city);
        $manager->persist($city);
        $manager->flush();

        $city = new City();
        $city->setName('Challans');
        $city->setSlug('challans');
        $city->setDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_2));
        $this->addReference(self::CITY_REFERENCE_3, $city);
        $manager->persist($city);
        $manager->flush();

        $city = new City();
        $city->setName('Luçon');
        $city->setSlug('lucon');
        $city->setDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_2));
        $this->addReference(self::CITY_REFERENCE_4, $city);
        $manager->persist($city);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DepartmentFixtures::class,
        ];
    }
}
