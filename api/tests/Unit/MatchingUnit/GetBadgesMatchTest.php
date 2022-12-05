<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\BadgeRepository;
use App\Service\MatchingService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetBadgesMatchTest extends KernelTestCase
{
    public function testGetBadgesMatchWithGoodValues(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
     
        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Equilibre vie pro/perso']));

        $applicantBadges = new ArrayCollection();
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Equilibre vie pro/perso']));

        $matchingService = static::getContainer()->get(MatchingService::class);
        $badgesMatch = $matchingService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(100, $badgesMatch);

        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));

        $applicantBadges = new ArrayCollection();
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));

        $badgesMatch = $matchingService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(100, $badgesMatch);

        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));

        $applicantBadges = new ArrayCollection();
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));

        $badgesMatch = $matchingService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(50, $badgesMatch);
    }

    public function testGetBadgesMatchWithNoApplicantValues(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
     
        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Equilibre vie pro/perso']));

        $applicantBadges = new ArrayCollection();

        $matchingService = static::getContainer()->get(MatchingService::class);
        $badgesMatch = $matchingService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(100, $badgesMatch);
    }

    public function testGetBadgesMatchWithNoMatchValues(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
     
        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'No costume']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Sport']));

        $applicantBadges = new ArrayCollection();
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Equilibre vie pro/perso']));

        $matchingService = static::getContainer()->get(MatchingService::class);
        $badgesMatch = $matchingService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(0, $badgesMatch);
    }
}