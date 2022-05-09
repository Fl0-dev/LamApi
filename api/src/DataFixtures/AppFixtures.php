<?php

namespace App\DataFixtures;

use App\Entity\Company\Group\CompanyGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create 20 company groups! Bam!
        for ($i = 0; $i < 20; $i++) {
            $companyGroup = new CompanyGroup();
            $companyGroup->setName('Groupe de Cabinet ' . $i);
            $manager->persist($companyGroup);
        }

        $manager->flush();
    }
}
