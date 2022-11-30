<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\JobTitleRepository;
use App\Service\MatchingService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetJobTitleMatchTest extends KernelTestCase
{
    public function testGetJobTitleMatchWithGoodValues(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
     
        $companyJobTitle= $jobTitleRepository->findOneBy(['label' => 'Expert Comptable']);
 
        $applicantJobTitle = $jobTitleRepository->findOneBy(['label' => 'Expert Comptable']);
 
        $matchingService = static::getContainer()->get(MatchingService::class);
        $jobTitleMatch = $matchingService->getJobTitleMatch($companyJobTitle, $applicantJobTitle);
 
        $this->assertIsInt($jobTitleMatch);
        $this->assertEquals(100, $jobTitleMatch);
    }

    public function testGetJobTitleMatchWithNoMatchValues(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);

        $companyJobTitle = $jobTitleRepository->findOneBy(['label' => 'Expertise comptable']);

        $applicantJobTitle = $jobTitleRepository->findOneBy(['label' => 'Numérique']);

        $matchingService = static::getContainer()->get(MatchingService::class);
        $jobTitleMatch = $matchingService->getJobTitleMatch($companyJobTitle, $applicantJobTitle);

        $this->assertIsInt($jobTitleMatch);
        $this->assertEquals(0, $jobTitleMatch);
    }
}