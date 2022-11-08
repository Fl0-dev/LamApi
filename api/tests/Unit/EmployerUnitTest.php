<?php

namespace App\Tests\Unit;

use App\Entity\User\Employer;
use App\Repository\UserRepositories\EmployerRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmployerUnitTests extends KernelTestCase
{
    public function testGetAllEmployers(): void
    {
        $employerRepository = static::getContainer()->get(EmployerRepository::class);
        $employers = $employerRepository->findAll();

        $this->assertIsArray($employers);
        $this->assertNotEmpty($employers);
        $this->assertContainsOnlyInstancesOf(Employer::class, $employers);
    }

    public function testAddEmployer(): void
    {
        $employer = new Employer();
        $employer->setEmail('test@gmail.com');
        $employer->setPassword('password');

        $employerRepository = static::getContainer()->get(EmployerRepository::class);
        $employerRepository->add($employer, true);

        $this->assertTrue(uuid_is_valid($employer->getId()));
    }

    public function testGetEmployerByGoodEmail(): void
    {
        $employerRepository = static::getContainer()->get(EmployerRepository::class);
        $employer = $employerRepository->findOneBy(['email' => 'test@gmail.com']);

        $this->assertInstanceOf(Employer::class, $employer);
    }

    public function testGetEmployerByApplicantEmail(): void
    {
        $employerRepository = static::getContainer()->get(EmployerRepository::class);
        $employer = $employerRepository->findOneBy(['email' => 'j-e@gmail.com']);

        $this->assertNotInstanceOf(Employer::class, $employer);
    }

    public function testAddEmployerByBadEmail(): void
    {
        $employer = new Employer();
        $employer->setEmail('test');
        $employer->setPassword('password');
        $employerRepository = static::getContainer()->get(EmployerRepository::class);

        $employerRepository->add($employer, true);

        $this->assertNotInstanceOf(Employer::class, $employerRepository->findOneBy(['email' => 'test']));
    }

    public function testAddEmployerByBadPassword(): void
    {
        $employer = new Employer();
        $employer->setEmail('testPassword@gmail.com');
        $employer->setPassword('pass');
        $employerRepository = static::getContainer()->get(EmployerRepository::class);

        $employerRepository->add($employer, true);

        $this->assertNotInstanceOf(Employer::class, $employerRepository->findOneBy(['email' => 'testPassword@gmail.com']));
    }

    public function testRemoveEmployerByMail(): void
    {
        $employerRepository = static::getContainer()->get(EmployerRepository::class);
        $employer = $employerRepository->findOneBy(['email' => 'test@gmail.com']);
        $employerRepository->remove($employer, true);

        $employer = $employerRepository->findOneBy(['email' => 'test@gmail.com']);
        $this->assertNull($employer);
    }
}
