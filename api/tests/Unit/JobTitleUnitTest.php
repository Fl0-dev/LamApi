<?php

namespace App\Tests\Unit;

use App\Entity\JobTitle;
use App\Repository\JobTitleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JobTitleUnitTest extends KernelTestCase
{

    public function testGetAllJobTitles(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitles = $jobTitleRepository->findAll();

        $this->assertIsArray($jobTitles);
        $this->assertNotEmpty($jobTitles);
        $this->assertContainsOnlyInstancesOf(JobTitle::class, $jobTitles);
    }

    public function testGetJobTitleByValue(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('assistant-administratif');
        $this->assertInstanceOf(JobTitle::class, $jobTitle);

        $jobTitleId = $jobTitle->getId();
        $jobTitle = $jobTitleRepository->find($jobTitleId);
        $this->assertInstanceOf(JobTitle::class, $jobTitle);
    }

    public function testAddJobTitleWithGoodValues(): void
    {
        $jobtitle = new JobTitle();
        $jobtitle->setSlug('test-job-title');
        $jobtitle->setLabel('Test Job Title');

        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitleRepository->add($jobtitle, true);

        $this->assertTrue(uuid_is_valid($jobtitle->getId()));
    }

    public function testUpdateJobTitleWithGoodValues(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('test-job-title');
        $jobTitle->setLabel('Test Job Title Updated');

        $jobTitleRepository->update($jobTitle, true);

        $this->assertEquals('Test Job Title Updated', $jobTitle->getLabel());
    }

    public function testUpdateJobTitleWithGoodSlug(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('test-job-title');
        $jobTitle->setSlug('test-job-title-updated');

        $jobTitleRepository->update($jobTitle, true);

        $this->assertEquals('test-job-title-updated', $jobTitle->getSlug());
    }
    public function testUpdateJobTitleWithWrongSlug(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);

        $jobTitle = $jobTitleRepository->findBySlug('test-job-title-updated');
        $jobTitle->setSlug('test-job-title updated');
        $jobTitleRepository->update($jobTitle, true);
        $this->assertEquals('test-job-title-updated', $jobTitle->getSlug());
    }

    public function testAddJobTitleWithEmptyValue(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = new JobTitle();

        try {
            $jobTitleRepository->add($jobTitle, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddJobTitleWithEmptyLabel(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = new JobTitle();
        $jobTitle->setSlug('test-job-title');

        try {
            $jobTitleRepository->add($jobTitle, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveJobTitle(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('test-job-title-updated');
        $jobTitleRepository->remove($jobTitle, true);

        $jobTitle = $jobTitleRepository->findBySlug('test-job-title-updated');
        $this->assertNull($jobTitle);
    }
}
