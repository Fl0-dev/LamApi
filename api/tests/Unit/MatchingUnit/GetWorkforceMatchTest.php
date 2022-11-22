<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Entity\References\Workforce;
use App\Service\ApplicantLamatchService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetWorkforceMatchTest extends KernelTestCase
{
    public function testGetWorkforceMatchWithGoodValues(): void
    {
        $companyWorkforceId = (new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId();
        $applicantWorkforceId = (new Workforce(Workforce::LEVEL_2, '10 à 19 salariés', 2))->getId();

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $workforceMatch = $applicantLamatchService->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);

        $this->assertIsInt($workforceMatch);
        $this->assertEquals(50, $workforceMatch);

        $workforceMatch = $applicantLamatchService->getWorkforceMatch($applicantWorkforceId, $companyWorkforceId);

        $this->assertIsInt($workforceMatch);
        $this->assertEquals(50, $workforceMatch);
    }

    public function testGetWorkforceMatchWithSameValues(): void
    {
        $companyWorkforceId = (new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId();
        $applicantWorkforceId = (new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId();

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $workforceMatch = $applicantLamatchService->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);

        $this->assertIsInt($workforceMatch);
        $this->assertEquals(100, $workforceMatch);
    }

    public function testGetWorkforceMatchWithBigDiffValues(): void
    {
        $companyWorkforceId = (new Workforce(Workforce::LEVEL_11, '+ de 10000 salariés', 11))->getId();
        $applicantWorkforceId = (new Workforce(Workforce::LEVEL_1, '1 à 9 salariés', 1))->getId();

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $workforceMatch = $applicantLamatchService->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);

        $this->assertIsInt($workforceMatch);
        $this->assertEquals(25, $workforceMatch);
    }

    public function testGetWorkforceMatchWithNoValueForApplicant(): void
    {
        $companyWorkforceId = (new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId();
        $applicantWorkforceId = null;

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $workforceMatch = $applicantLamatchService->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);

        $this->assertIsInt($workforceMatch);
        $this->assertEquals(100, $workforceMatch);
    }
}   