<?php

namespace App\Tests\Unit;

use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Repository\SubscriptionRepositories\DISC\DISCPersonalityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DISCPersonalityUnitTest extends KernelTestCase
{

    public function testGetAllDISCPersonalities(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonalities = $DISCPersonalityRepository->findAll();

        $this->assertIsArray($DISCPersonalities);
        $this->assertNotEmpty($DISCPersonalities);
        $this->assertContainsOnlyInstancesOf(DISCPersonality::class, $DISCPersonalities);
    }

    public function testGetDISCPersonalityByValue(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'dominant']);
        $this->assertInstanceOf(DISCPersonality::class, $DISCPersonality);

        $DISCPersonalityId = $DISCPersonality->getId();
        $DISCPersonality = $DISCPersonalityRepository->find($DISCPersonalityId);
        $this->assertInstanceOf(DISCPersonality::class, $DISCPersonality);
    }

    public function testNoGetDISCPersonalityByValue(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'nimportequoi']);
        $this->assertNotInstanceOf(DISCPersonality::class, $DISCPersonality);

        $DISCPersonality = $DISCPersonalityRepository->find('1ed5ea1a-2af6-6aea-b8cf-9513b2072358');
        $this->assertNotInstanceOf(DISCPersonality::class, $DISCPersonality);
    }

    public function testAddDISCPersonalityWithGoodValues(): void
    {
        $DISCPersonality = new DISCPersonality();
        $DISCPersonality->setSlug('test-DISCPersonality');
        $DISCPersonality->setLabel('Test DISCPersonality');
        $DISCPersonality->setColor('color');

        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonalityRepository->add($DISCPersonality, true);

        $this->assertTrue(uuid_is_valid($DISCPersonality->getId()));
    }

    public function testUpdateDISCPersonalityWithGoodValues(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'test-DISCPersonality']);
        $DISCPersonality->setLabel('Test DISCPersonality Updated');

        $DISCPersonalityRepository->add($DISCPersonality, true);

        $this->assertEquals('Test DISCPersonality Updated', $DISCPersonality->getLabel());
    }

    public function testUpdateDISCPersonalityWithGoodSlug(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'test-DISCPersonality']);
        $DISCPersonality->setSlug('test-DISCPersonality-updated');

        $DISCPersonalityRepository->add($DISCPersonality, true);

        $this->assertEquals('test-DISCPersonality-updated', $DISCPersonality->getSlug());
    }
    public function testUpdateDISCPersonalityWithWrongSlug(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);

        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'test-DISCPersonality-updated']);
        $DISCPersonality->setSlug('test-DISCPersonality updated');
        $DISCPersonalityRepository->add($DISCPersonality, true);
        $this->assertEquals('test-discpersonality-updated', $DISCPersonality->getSlug());
    }

    public function testAddDISCPersonalityWithEmptyValue(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = new DISCPersonality();

        try {
            $DISCPersonalityRepository->add($DISCPersonality, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddDISCPersonalityWithEmptyLabel(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = new DISCPersonality();
        $DISCPersonality->setSlug('test-DISCPersonality');

        try {
            $DISCPersonalityRepository->add($DISCPersonality, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveDISCPersonality(): void
    {
        $DISCPersonalityRepository = static::getContainer()->get(DISCPersonalityRepository::class);
        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'test-discpersonality-updated']);
        $DISCPersonalityRepository->remove($DISCPersonality, true);

        $DISCPersonality = $DISCPersonalityRepository->findOneBy(['slug' => 'test-discpersonality-updated']);
        $this->assertNull($DISCPersonality);
    }
}
