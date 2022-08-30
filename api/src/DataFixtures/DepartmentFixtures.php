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

    public function load(ObjectManager $manager)
    {
        $department = new Department();
        $department->setName('Loire-Atlantique');
        $department->setCode('44');
        $department->setSlug('loire-atlantique');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE));
        $this->addReference(self::DEPARTMENT_REFERENCE_1, $department);
        $manager->persist($department);

        $department = new Department();
        $department->setName('Vendée');
        $department->setCode('85');
        $department->setSlug('vendee');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE));
        $this->addReference(self::DEPARTMENT_REFERENCE_2, $department);
        $manager->persist($department);

        $department = new Department();
        $department->setName('Mayenne');
        $department->setCode('53');
        $department->setSlug('mayenne');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE));
        $this->addReference(self::DEPARTMENT_REFERENCE_3, $department);
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
