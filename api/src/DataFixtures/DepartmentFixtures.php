<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const DEPARTMENT_REFERENCE_1 = 'department1';
    public const DEPARTMENT_REFERENCE_2 = 'department2';

    public function load(ObjectManager $manager)
    {
        $department = new Department();
        $department->setName('Loire-Atlantique');
        $department->setSlug('loire-atlantique');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE));
        $this->addReference(self::DEPARTMENT_REFERENCE_1, $department);
        $manager->persist($department);

        $department = new Department();
        $department->setName('Vendée');
        $department->setSlug('vendee');
        $department->setRegion($this->getReference(RegionFixtures::REGION_REFERENCE));
        $this->addReference(self::DEPARTMENT_REFERENCE_2, $department);
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