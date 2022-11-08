<?php

namespace App\Tests\Unit;

use App\Entity\Subscriptions\DISC\DISCQuality;
use App\Repository\SubscriptionRepositories\DISC\DISCPersonalityRepository;
use App\Repository\SubscriptionRepositories\DISC\DISCQualityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DISCQualityUnitTest extends KernelTestCase
{

    public function testGetAllDISCQualities(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQualities = $DISCQualityRepository->findAll();

        $this->assertIsArray($DISCQualities);
        $this->assertNotEmpty($DISCQualities);
        $this->assertContainsOnlyInstancesOf(DISCQuality::class, $DISCQualities);
    }

    public function testGetDISCQualityByValue(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'direct']);
        $this->assertInstanceOf(DISCQuality::class, $DISCQuality);

        $DISCQualityId = $DISCQuality->getId();
        $DISCQuality = $DISCQualityRepository->find($DISCQualityId);
        $this->assertInstanceOf(DISCQuality::class, $DISCQuality);
    }

    public function testNoGetDISCQualityByValue(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'nimportequoi']);
        $this->assertNotInstanceOf(DISCQuality::class, $DISCQuality);

        $DISCQuality = $DISCQualityRepository->find('1ed5ea1a-2af6-6aea-b8cf-9513b2072358');
        $this->assertNotInstanceOf(DISCQuality::class, $DISCQuality);
    }

    public function testAddDISCQualityWithGoodValues(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCQuality = new DISCQuality();
        $DISCQuality->setSlug('test-disc-quality');
        $DISCQuality->setLabel('Test DISC Quality');
        $DISCQuality->setPersonality($DISCPersonalityRepository->findOneBy(['slug' => 'dominant']));

        $DISCQualityRepository->add($DISCQuality, true);

        $this->assertTrue(uuid_is_valid($DISCQuality->getId()));
    }

    public function testUpdateDISCQualityWithGoodValues(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'test-disc-quality']);
        $DISCQuality->setLabel('Test DISC Quality Updated');

        $DISCQualityRepository->add($DISCQuality, true);

        $this->assertEquals('Test DISC Quality Updated', $DISCQuality->getLabel());
    }

    public function testUpdateDISCQualityWithGoodSlug(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'test-disc-quality']);
        $DISCQuality->setSlug('test-disc-quality-updated');

        $DISCQualityRepository->add($DISCQuality, true);

        $this->assertEquals('test-disc-quality-updated', $DISCQuality->getSlug());
    }
    public function testUpdateDISCQualityWithWrongSlug(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);

        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'test-disc-quality-updated']);
        $DISCQuality->setSlug('test-disc-quality updated');
        $DISCQualityRepository->add($DISCQuality, true);
        $this->assertEquals('test-disc-quality-updated', $DISCQuality->getSlug());
    }

    public function testAddDISCQualityWithEmptyValue(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = new DISCQuality();

        try {
            $DISCQualityRepository->add($DISCQuality, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddDISCQualityWithEmptyLabel(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = new DISCQuality();
        $DISCQuality->setSlug('test-disc-quality');

        try {
            $DISCQualityRepository->add($DISCQuality, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddDISCQualityWithWrongPersonality(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = new DISCQuality();
        $DISCQuality->setSlug('test-disc-quality');
        $DISCQuality->setLabel('Test DISC Quality');

        try {
            $DISCQualityRepository->add($DISCQuality, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveDISCQuality(): void
    {
        $DISCQualityRepository = static::getContainer()->get(DISCQualityRepository::class);
        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'test-disc-quality-updated']);
        $DISCQualityRepository->remove($DISCQuality, true);

        $DISCQuality = $DISCQualityRepository->findOneBy(['slug' => 'test-disc-quality-updated']);
        $this->assertNull($DISCQuality);
    }
}
