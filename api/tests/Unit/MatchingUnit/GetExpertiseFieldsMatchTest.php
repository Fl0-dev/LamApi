<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\ExpertiseFieldRepository;
use App\Service\MatchingService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetExpertiseFieldsMatchTest extends KernelTestCase
{
    public function testGetExpertiseFieldsMatchWithGoodValues(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
     
        $companyExpertiseFields = new ArrayCollection();
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Agricole']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Social']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Finance']));

        $applicantExpertiseFields = new ArrayCollection();
        $applicantExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Social']));
        $applicantExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Finance']));
        $applicantExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Agricole']));

        $matchingService = static::getContainer()->get(MatchingService::class);
        $expertiseFieldsMatch = $matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(100, $expertiseFieldsMatch);
    }

    public function testGetExpertiseFieldsMatchWithNoMatchValues(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
     
        $companyExpertiseFields = new ArrayCollection();
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Agricole']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Social']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Finance']));

        $applicantExpertiseFields = new ArrayCollection();
        $applicantExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Banque']));

        $matchingService = static::getContainer()->get(MatchingService::class);
        $expertiseFieldsMatch = $matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(0, $expertiseFieldsMatch);

        $companyExpertiseFields = new ArrayCollection();
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Banque']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Social']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Finance']));

        $applicantExpertiseFields = new ArrayCollection();
        $applicantExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Agricole']));

        $expertiseFieldsMatch = $matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(0, $expertiseFieldsMatch);
    }

    public function testGetExpertiseFieldsMatchWithNoApplicantExpertiseValue(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);

        $companyExpertiseFields = new ArrayCollection();
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Agricole']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Social']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Finance']));

        $applicantExpertiseFields = null;

        $matchingService = static::getContainer()->get(MatchingService::class);
        $expertiseFieldsMatch = $matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(100, $expertiseFieldsMatch);

        $applicantExpertiseFields = new ArrayCollection();

        $expertiseFieldsMatch = $matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(100, $expertiseFieldsMatch);
    }
}