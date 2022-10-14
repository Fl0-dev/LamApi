<?php

namespace App\DataFixtures;

use App\Entity\User\Employer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployerFixtures extends Fixture
{
    public const EMPLOYER_REFERENCE_1 = 'employer_1';
    public const EMPLOYER_REFERENCE_2 = 'employer_2';
    public const EMPLOYER_REFERENCE_3 = 'employer_3';
    public const EMPLOYER_REFERENCE_4 = 'employer_4';

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('jp@gmail.com');
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setFirstName('Jean-Pierre');
        $employer->setLastName('Dupont');
        $employer->setBirthdate(new \DateTime('1980-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_1, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('marie@gmail.com');
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setFirstName('Marie');
        $employer->setLastName('Duval');
        $employer->setBirthdate(new \DateTime('1995-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_2, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('Lea@gmail.com');
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setFirstName('Lea');
        $employer->setLastName('Rivali');
        $employer->setBirthdate(new \DateTime('1985-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_3, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('Pierre@gmail.com');
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setFirstName('Pierre');
        $employer->setLastName('Curé');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_4, $employer);

        $manager->persist($employer);
        $manager->flush();
    }
}
