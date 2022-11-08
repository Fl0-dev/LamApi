<?php

namespace App\Tests\Unit;

use App\Entity\Badge;
use App\Repository\BadgeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BadgeUnitTest extends KernelTestCase
{

    public function testGetAllBadges(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badges = $badgeRepository->findAll();

        $this->assertIsArray($badges);
        $this->assertNotEmpty($badges);
        $this->assertContainsOnlyInstancesOf(Badge::class, $badges);
    }

    public function testGetBadgeByValue(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = $badgeRepository->findOneBy(['slug' => 'impact-plus']);
        $this->assertInstanceOf(Badge::class, $badge);

        $badgeId = $badge->getId();
        $badge = $badgeRepository->find($badgeId);
        $this->assertInstanceOf(Badge::class, $badge);
    }

    public function testNoGetBadgeByValue(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = $badgeRepository->findOneBy(['slug' => 'nimportequoi']);
        $this->assertNotInstanceOf(Badge::class, $badge);

        $badge = $badgeRepository->find('1ed5ea1a-2af6-6aea-b8cf-9513b2072358');
        $this->assertNotInstanceOf(Badge::class, $badge);
    }

    public function testAddBadgeWithGoodValues(): void
    {
        $badge = new Badge();
        $badge->setSlug('test-badge');
        $badge->setLabel('Test Badge');

        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badgeRepository->add($badge, true);

        $this->assertTrue(uuid_is_valid($badge->getId()));
    }

    public function testUpdateBadgeWithGoodValues(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = $badgeRepository->findOneBy(['slug' => 'test-badge']);
        $badge->setLabel('Test Badge Updated');

        $badgeRepository->add($badge, true);

        $this->assertEquals('Test Badge Updated', $badge->getLabel());
    }

    public function testUpdateBadgeWithGoodSlug(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = $badgeRepository->findOneBy(['slug' => 'test-badge']);
        $badge->setSlug('test-badge-updated');

        $badgeRepository->add($badge, true);

        $this->assertEquals('test-badge-updated', $badge->getSlug());
    }
    public function testUpdateBadgeWithWrongSlug(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);

        $badge = $badgeRepository->findOneBy(['slug' => 'test-badge-updated']);
        $badge->setSlug('test-badge updated');
        $badgeRepository->add($badge, true);
        $this->assertEquals('test-badge-updated', $badge->getSlug());
    }

    public function testAddBadgeWithEmptyValue(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = new Badge();

        try {
            $badgeRepository->add($badge, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddBadgeWithEmptyLabel(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = new Badge();
        $badge->setSlug('test-badge');

        try {
            $badgeRepository->add($badge, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveBadge(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = $badgeRepository->findOneBy(['slug' => 'test-badge-updated']);
        $badgeRepository->remove($badge, true);

        $badge = $badgeRepository->findOneBy(['slug' => 'test-badge-updated']);
        $this->assertNull($badge);
    }
}
