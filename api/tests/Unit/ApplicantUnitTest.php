<?php

namespace App\Tests\Unit;

use App\Entity\Applicant\Applicant;
use App\Repository\ApplicantRepositories\ApplicantRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApplicantUnitTests extends KernelTestCase
{
    public function testGetAllApplicants(): void
    {
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);
        $applicants = $applicantRepository->findAll();

        $this->assertIsArray($applicants);
        $this->assertNotEmpty($applicants);
        $this->assertContainsOnlyInstancesOf(Applicant::class, $applicants);
    }

    public function testAddApplicant(): void
    {
        $applicant = new Applicant();
        $applicant->setEmail('test@gmail.com');
        $applicant->setPassword('password');
        $applicant->setFirstName('John');
        $applicant->setLastName('Doe');

        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);
        $applicantRepository->add($applicant, true);

        $this->assertTrue(uuid_is_valid($applicant->getId()));
    }

    public function testGetApplicantByGoodEmail(): void
    {
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);
        $applicant = $applicantRepository->findOneBy(['email' => 'test@gmail.com']);

        $this->assertInstanceOf(Applicant::class, $applicant);
    }

    public function testGetApplicantByEmployerEmail(): void
    {
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);
        $applicant = $applicantRepository->findOneBy(['email' => 'jp@gmail.com']);

        $this->assertNotInstanceOf(Applicant::class, $applicant);
    }

    public function testAddApplicantByBadEmail(): void
    {
        $applicant = new Applicant();
        $applicant->setEmail('test');
        $applicant->setPassword('password');
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);

        $applicantRepository->add($applicant, true);

        $this->assertNotInstanceOf(Applicant::class, $applicantRepository->findOneBy(['email' => 'test']));
    }

    // public function testAddApplicantByAllreadyUsedEmail(): void
    // {
    //     $applicant = new Applicant();
    //     $applicant->setEmail('test@gmail.com');
    //     $applicant->setPassword('password');
    //     $applicantRepository = static::getContainer()->get(ApplicantRepository::class);

    //     $applicantRepository->add($applicant, true);

        
    // }

    public function testAddApplicantByBadPassword(): void
    {
        $applicant = new Applicant();
        $applicant->setEmail('testPassword@gmail.com');
        $applicant->setPassword('pass');
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);

        $applicantRepository->add($applicant, true);

        $this->assertNotInstanceOf(Applicant::class, $applicantRepository->findOneBy(['email' => 'testPassword@gmail.com']));
    }

    public function testRemoveApplicantByMail(): void
    {
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);
        $applicant = $applicantRepository->findOneBy(['email' => 'test@gmail.com']);
        $applicantRepository->remove($applicant, true);

        $applicant = $applicantRepository->findOneBy(['email' => 'test@gmail.com']);
        $this->assertNull($applicant);
    }
}
