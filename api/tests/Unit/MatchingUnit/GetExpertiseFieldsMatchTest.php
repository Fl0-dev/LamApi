<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\ExpertiseFieldRepository;
use App\Service\ApplicantLamatchService;
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

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $expertiseFieldsMatch = $applicantLamatchService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

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

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $expertiseFieldsMatch = $applicantLamatchService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(0, $expertiseFieldsMatch);

        $companyExpertiseFields = new ArrayCollection();
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Banque']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Social']));
        $companyExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Finance']));

        $applicantExpertiseFields = new ArrayCollection();
        $applicantExpertiseFields->add($expertiseFieldRepository->findOneBy(['label' => 'Agricole']));

        $expertiseFieldsMatch = $applicantLamatchService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

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

        $applicantLamatchService = static::getContainer()->get(ApplicantLamatchService::class);
        $expertiseFieldsMatch = $applicantLamatchService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);

        $this->assertIsInt($expertiseFieldsMatch);
        $this->assertEquals(100, $expertiseFieldsMatch);
    }
}