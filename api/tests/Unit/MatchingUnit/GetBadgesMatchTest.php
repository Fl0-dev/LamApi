<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\BadgeRepository;
use App\Service\ApplicantLamatchService;
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

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $badgesMatch = $applicantLamatchService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(100, $badgesMatch);

        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));

        $applicantBadges = new ArrayCollection();
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));

        $badgesMatch = $applicantLamatchService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(100, $badgesMatch);

        $companyBadges = new ArrayCollection();
        $companyBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));

        $applicantBadges = new ArrayCollection();
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Cabinet à impact +']));
        $applicantBadges->add($badgeRepository->findOneBy(['label' => 'Café et thé illimité']));

        $badgesMatch = $applicantLamatchService->getBadgesMatch($companyBadges, $applicantBadges);

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

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $badgesMatch = $applicantLamatchService->getBadgesMatch($companyBadges, $applicantBadges);

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

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $badgesMatch = $applicantLamatchService->getBadgesMatch($companyBadges, $applicantBadges);

        $this->assertIsInt($badgesMatch);
        $this->assertEquals(0, $badgesMatch);
    }
}