<?php

namespace App\DataFixtures;

use App\Entity\Company\Group\CompanyGroup;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures
{
    public function getCompanies()
    {
        // Create 20 company groups! Bam!
        for ($i = 0; $i < 20; $i++) {
            $companyGroup = new CompanyGroup();
            $companyGroup->setName('Groupe de Cabinet ' . $i);
        }
    }
}
