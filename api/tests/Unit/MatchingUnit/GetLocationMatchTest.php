<?php

namespace App\Tests\Unit\MatchingUnit;

use App\Entity\Subscriptions\Applicant\Lamatch\DesiredLocation;
use App\Repository\LocationRepositories\CityRepository;
use App\Repository\LocationRepositories\DepartmentRepository;
use App\Service\MatchingService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetLocationMatchTest extends KernelTestCase
{
    public function testGetLocationMatchWithGoodCitiesValuesWithApplicantContext(): void
    {
        $matchingService = static::getContainer()->get(MatchingService::class);
        $cityRepository = static::getContainer()->get(CityRepository::class);

        $companyCities = new ArrayCollection();
        $city = $cityRepository->findOneBy(['name' => 'Nantes']);
        $companyCities->add($city);
        $city = $cityRepository->findOneBy(['name' => 'Saint-Nazaire']);
        $companyCities->add($city);

        $applicantLocation = new DesiredLocation();
        $city = $cityRepository->findOneBy(['name' => 'Nantes']);
        $applicantLocation->addDesiredCity($city);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'applicant');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);

        $city = $cityRepository->findOneBy(['name' => 'Saint-Nazaire']);
        $applicantLocation->addDesiredCity($city);
        $city = $cityRepository->findOneBy(['name' => 'Châlons-en-Champagne']);
        $applicantLocation->addDesiredCity($city);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'applicant');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(66, $locationMatch);

        $applicantLocation->removeDesiredCity($cityRepository->findOneBy(['name' => 'Saint-Nazaire']));
        $applicantLocation->removeDesiredCity($cityRepository->findOneBy(['name' => 'Nantes']));

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'applicant');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(0, $locationMatch);
    }

    public function testGetLocationMatchWithGoodCitiesValuesWithEmployerContext(): void
    {
        $matchingService = static::getContainer()->get(MatchingService::class);
        $cityRepository = static::getContainer()->get(CityRepository::class);

        $companyCities = new ArrayCollection();
        $city = $cityRepository->findOneBy(['name' => 'Nantes']);
        $companyCities->add($city);

        $applicantLocation = new DesiredLocation();
        $city = $cityRepository->findOneBy(['name' => 'Nantes']);
        $applicantLocation->addDesiredCity($city);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);

        $city = $cityRepository->findOneBy(['name' => 'Saint-Nazaire']);
        $applicantLocation->addDesiredCity($city);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);

        $companyCities = new ArrayCollection();
        $city = $cityRepository->findOneBy(['name' => 'Metz']);
        $companyCities->add($city);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(0, $locationMatch);

        $applicantLocation->addDesiredCity($city);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);
    }

    public function testGetLocationMatchWithGoodDepartmentsValuesWithApplicantContext(): void
    {
        $matchingService = static::getContainer()->get(MatchingService::class);
        $cityRepository = static::getContainer()->get(CityRepository::class);
        $departmentRepository = static::getContainer()->get(DepartmentRepository::class);

        $companyCities = new ArrayCollection();
        $city = $cityRepository->findOneBy(['name' => 'Nantes']);
        $companyCities->add($city);
        $city = $cityRepository->findOneBy(['name' => 'Saint-Nazaire']);
        $companyCities->add($city);

        $applicantLocation = new DesiredLocation();

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'applicant');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(0, $locationMatch);

        $department = $departmentRepository->findOneBy(['name' => 'Loire-Atlantique']);
        $applicantLocation->addDesiredDepartment($department);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'applicant');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);

        $department = $departmentRepository->findOneBy(['name' => 'Loire-Atlantique']);
        $applicantLocation->addDesiredDepartment($department);
        $department = $departmentRepository->findOneBy(['name' => 'Marne']);
        $applicantLocation->addDesiredDepartment($department);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'applicant');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(50, $locationMatch);
    }

    public function testGetLocationMatchWithGoodDepartmentsValuesWithEmployerContext(): void
    {
        $matchingService = static::getContainer()->get(MatchingService::class);
        $cityRepository = static::getContainer()->get(CityRepository::class);
        $departmentRepository = static::getContainer()->get(DepartmentRepository::class);

        $companyCities = new ArrayCollection();
        $city = $cityRepository->findOneBy(['name' => 'Nantes']);
        $companyCities->add($city);

        $applicantLocation = new DesiredLocation();
        $department = $departmentRepository->findOneBy(['name' => 'Loire-Atlantique']);
        $applicantLocation->addDesiredDepartment($department);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);

        $department = $departmentRepository->findOneBy(['name' => 'Vendée']);
        $applicantLocation->addDesiredDepartment($department);

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(100, $locationMatch);

        $applicantLocation->removeDesiredDepartment($departmentRepository->findOneBy(['name' => 'Loire-Atlantique']));

        $locationMatch = $matchingService->getLocationMatch($companyCities, $applicantLocation, 'employer');

        $this->assertIsInt($locationMatch);
        $this->assertEquals(0, $locationMatch);
    }
}
