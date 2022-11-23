<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\JobTitleRepository;
use App\Repository\JobTypeRepository;
use App\Service\ApplicantLamatchService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetJobTitleMatchTest extends KernelTestCase
{
    public function testGetJobTitleMatchWithGoodValues(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
     
        $companyJobtypes = new ArrayCollection();
        $companyJobtypes->add($jobTypeRepository->findOneBy(['label' => 'Expertise comptable']));
        $companyJobtypes->add($jobTypeRepository->findOneBy(['label' => 'Juridique']));
 
        $applicantJobTitle = $jobTitleRepository->findOneBy(['label' => 'Expert Comptable']);
        $applicantJobTypes = $applicantJobTitle->getJobTypes();
 
        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $jobTitleMatch = $applicantLamatchService->getJobTitleMatch($companyJobtypes, $applicantJobTypes);
 
        $this->assertIsInt($jobTitleMatch);
        $this->assertEquals(100, $jobTitleMatch);
    }

    public function testGetJobTitleMatchWithNoMatchValues(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);

        $companyJobtypes = new ArrayCollection();
        $companyJobtypes->add($jobTypeRepository->findOneBy(['label' => 'Expertise comptable']));
        $companyJobtypes->add($jobTypeRepository->findOneBy(['label' => 'Juridique']));

        $applicantJobTitle = $jobTitleRepository->findOneBy(['label' => 'Numérique']);
        $applicantJobTypes = $applicantJobTitle->getJobTypes();

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $jobTitleMatch = $applicantLamatchService->getJobTitleMatch($companyJobtypes, $applicantJobTypes);

        $this->assertIsInt($jobTitleMatch);
        $this->assertEquals(0, $jobTitleMatch);
    }

    public function testGetJobTitleMatchWithNoApplicantValues(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);

        $companyJobtypes = new ArrayCollection();
        $companyJobtypes->add($jobTypeRepository->findOneBy(['label' => 'Expertise comptable']));
        $companyJobtypes->add($jobTypeRepository->findOneBy(['label' => 'Juridique']));

        $applicantJobTypes = null;

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $jobTitleMatch = $applicantLamatchService->getJobTitleMatch($companyJobtypes, $applicantJobTypes);

        $this->assertIsInt($jobTitleMatch);
        $this->assertEquals(0, $jobTitleMatch);
    }
}