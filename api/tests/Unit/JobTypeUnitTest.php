<?php

namespace App\Tests\Unit;

use App\Entity\JobType;
use App\Repository\JobTypeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JobTypeUnitTest extends KernelTestCase
{

    public function testGetAllJobTypes(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobTypes = $jobTypeRepository->findAll();

        $this->assertIsArray($jobTypes);
        $this->assertNotEmpty($jobTypes);
        $this->assertContainsOnlyInstancesOf(JobType::class, $jobTypes);
    }

    public function testGetJobTypeByValue(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = $jobTypeRepository->findOneBy(['slug' => 'expertise-comptable']);
        $this->assertInstanceOf(JobType::class, $jobType);

        $jobTypeId = $jobType->getId();
        $jobType = $jobTypeRepository->find($jobTypeId);
        $this->assertInstanceOf(JobType::class, $jobType);
    }

    public function testNoGetJobTypeByValue(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = $jobTypeRepository->findOneBy(['slug' => 'nimportequoi']);
        $this->assertNotInstanceOf(JobType::class, $jobType);

        $jobType = $jobTypeRepository->find('1ed5ea1a-2af6-6aea-b8cf-9513b2072358');
        $this->assertNotInstanceOf(JobType::class, $jobType);
    }

    public function testAddJobTypeWithGoodValues(): void
    {
        $jobType = new JobType();
        $jobType->setSlug('test-job-type');
        $jobType->setLabel('Test Job Type');

        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobTypeRepository->add($jobType, true);

        $this->assertTrue(uuid_is_valid($jobType->getId()));
    }

    public function testUpdateJobTypeWithGoodValues(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = $jobTypeRepository->findOneBy(['slug' => 'test-job-type']);
        $jobType->setLabel('Test Job Type Updated');

        $jobTypeRepository->add($jobType, true);

        $this->assertEquals('Test Job Type Updated', $jobType->getLabel());
    }

    public function testUpdateJobTypeWithGoodSlug(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = $jobTypeRepository->findOneBy(['slug' => 'test-job-type']);
        $jobType->setSlug('test-job-type-updated');

        $jobTypeRepository->add($jobType, true);

        $this->assertEquals('test-job-type-updated', $jobType->getSlug());
    }
    public function testUpdateJobTypeWithWrongSlug(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);

        $jobType = $jobTypeRepository->findOneBy(['slug' => 'test-job-type-updated']);
        $jobType->setSlug('test-job-type updated');
        $jobTypeRepository->add($jobType, true);
        $this->assertEquals('test-job-type-updated', $jobType->getSlug());
    }

    public function testAddJobTypeWithEmptyValue(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = new JobType();

        try {
            $jobTypeRepository->add($jobType, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddJobTypeWithEmptyLabel(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = new JobType();
        $jobType->setSlug('test-job-type');

        try {
            $jobTypeRepository->add($jobType, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveJobType(): void
    {
        $jobTypeRepository = static::getContainer()->get(JobTypeRepository::class);
        $jobType = $jobTypeRepository->findOneBy(['slug' => 'test-job-type-updated']);
        $jobTypeRepository->remove($jobType, true);

        $jobType = $jobTypeRepository->findOneBy(['slug' => 'test-job-type-updated']);
        $this->assertNull($jobType);
    }
}
