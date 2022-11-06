<?php

namespace App\DataFixtures;

use App\Entity\Subscriptions\Applicant\Lamatch\DesiredLocation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DesiredLocationFixtures extends Fixture implements DependentFixtureInterface
{
    public const DESIRED_LOCATION_REFERENCE_1 = 'desired_location1';
    public const DESIRED_LOCATION_REFERENCE_2 = 'desired_location2';
    public const DESIRED_LOCATION_REFERENCE_3 = 'desired_location3';
    public const DESIRED_LOCATION_REFERENCE_4 = 'desired_location4';
    public const DESIRED_LOCATION_REFERENCE_5 = 'desired_location5';
    public const DESIRED_LOCATION_REFERENCE_6 = 'desired_location6';
    public const DESIRED_LOCATION_REFERENCE_7 = 'desired_location7';
    public const DESIRED_LOCATION_REFERENCE_8 = 'desired_location8';
    public const DESIRED_LOCATION_REFERENCE_9 = 'desired_location9';

    public function load(ObjectManager $manager): void
    {
        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_1, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_3));
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_4));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_2, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_2));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_3, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_5));
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_6));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_4, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_3));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_4));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_5));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_6));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_5, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_7));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_6));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_6, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredCity($this->getReference(CityFixtures::CITY_REFERENCE_5));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_7, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_2));
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_3));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_8, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();

        $desiredLocation = new DesiredLocation();
        $desiredLocation->setCreatedDate(new \DateTime());
        $desiredLocation->setLastModifiedDate(new \DateTime());
        $desiredLocation->addDesiredDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE_1));
        $this->addReference(self::DESIRED_LOCATION_REFERENCE_9, $desiredLocation);
        $manager->persist($desiredLocation);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CityFixtures::class,
            DepartmentFixtures::class,
        ];
    }
}
