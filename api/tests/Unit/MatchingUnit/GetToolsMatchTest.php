<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Repository\ToolRepository;
use App\Service\MatchingService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetToolssMatchTest extends KernelTestCase
{
    public function testGetToolsMatchWithGoodValues(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
     
        $companyTools = new ArrayCollection();
        $companyTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Dext']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Fygr']));

        $applicantTools = new ArrayCollection();
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Dext']));
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Fygr']));

        $matchingService = static::getContainer()->get(MatchingService::class);
        $toolsMatch = $matchingService->getToolsMatch($companyTools, $applicantTools);

        $this->assertIsInt($toolsMatch);
        $this->assertEquals(100, $toolsMatch);

        $companyTools = new ArrayCollection();
        $companyTools->add($toolRepository->findOneBy(['label' => 'Teams']));

        $applicantTools = new ArrayCollection();
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Dext']));

        $toolsMatch = $matchingService->getToolsMatch($companyTools, $applicantTools);

        $this->assertIsInt($toolsMatch);
        $this->assertEquals(100, $toolsMatch);

        $companyTools = new ArrayCollection();
        $companyTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Dext']));

        $applicantTools = new ArrayCollection();
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Teams']));

        $toolsMatch = $matchingService->getToolsMatch($companyTools, $applicantTools);
        
        $this->assertIsInt($toolsMatch);
        $this->assertEquals(50, $toolsMatch);

        $companyTools = new ArrayCollection();
        $companyTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Dext']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Fygr']));

        $applicantTools = new ArrayCollection();
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Dext']));

        $toolsMatch = $matchingService->getToolsMatch($companyTools, $applicantTools);
        
        $this->assertIsInt($toolsMatch);
        $this->assertEquals(66, $toolsMatch);

        $companyTools = new ArrayCollection();
        $companyTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Dext']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Fygr']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'RCA']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Pennylane']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Tiime']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Silae']));

        $applicantTools = new ArrayCollection();
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Dext']));
        $applicantTools->add($toolRepository->findOneBy(['label' => 'Fygr']));

        $toolsMatch = $matchingService->getToolsMatch($companyTools, $applicantTools);
    
        $this->assertIsInt($toolsMatch);
        $this->assertEquals(42, $toolsMatch);
    }

    public function testGetToolsMatchWithNoApplicantValues(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
     
        $companyTools = new ArrayCollection();
        $companyTools->add($toolRepository->findOneBy(['label' => 'Teams']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Dext']));
        $companyTools->add($toolRepository->findOneBy(['label' => 'Fygr']));

        $applicantTools = new ArrayCollection();

        $matchingService = static::getContainer()->get(MatchingService::class);
        $toolsMatch = $matchingService->getToolsMatch($companyTools, $applicantTools);

        $this->assertIsInt($toolsMatch);
        $this->assertEquals(0, $toolsMatch);
    }
}