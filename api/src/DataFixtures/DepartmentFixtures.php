<?php

namespace App\DataFixtures;

use App\Entity\Location\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const DEPARTMENT_REFERENCE_1 = 'department1';
    public const DEPARTMENT_REFERENCE_2 = 'department2';
    public const DEPARTMENT_REFERENCE_3 = 'department3';
    public const DEPARTMENT_REFERENCE_4 = 'department4';
    public const DEPARTMENT_REFERENCE_5 = 'department5';
    public const DEPARTMENT_REFERENCE_6 = 'department6';

    public function load(ObjectManager $manager): void
    {
        $department = new Department();
        $department->setName('Loire-Atlantique');
        $department->setCode('44');
        $department->setSlug('loire-atlantique');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE_1));
        $this->addReference(self::DEPARTMENT_REFERENCE_1, $department);
        $manager->persist($department);
        $manager->flush();

        $department = new Department();
        $department->setName('Vendée');
        $department->setCode('85');
        $department->setSlug('vendee');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE_1));
        $this->addReference(self::DEPARTMENT_REFERENCE_2, $department);
        $manager->persist($department);
        $manager->flush();

        $department = new Department();
        $department->setName('Mayenne');
        $department->setCode('53');
        $department->setSlug('mayenne');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE_1));
        $this->addReference(self::DEPARTMENT_REFERENCE_3, $department);
        $manager->persist($department);
        $manager->flush();

        $department = new Department();
        $department->setName('Meuse');
        $department->setCode('55');
        $department->setSlug('meuse');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE_2));
        $this->addReference(self::DEPARTMENT_REFERENCE_4, $department);
        $manager->persist($department);
        $manager->flush();

        $department = new Department();
        $department->setName('Moselle');
        $department->setCode('57');
        $department->setSlug('moselle');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE_2));
        $this->addReference(self::DEPARTMENT_REFERENCE_5, $department);
        $manager->persist($department);
        $manager->flush();

        $department = new Department();
        $department->setName('Marne');
        $department->setCode('51');
        $department->setSlug('marne');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE_2));
        $this->addReference(self::DEPARTMENT_REFERENCE_6, $department);
        $manager->persist($department);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RegionFixtures::class,
        ];
    }
}
