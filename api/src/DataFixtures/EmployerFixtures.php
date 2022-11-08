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
    public const EMPLOYER_REFERENCE_5 = 'employer_5';
    public const EMPLOYER_REFERENCE_6 = 'employer_6';
    public const EMPLOYER_REFERENCE_7 = 'employer_7';
    public const EMPLOYER_REFERENCE_8 = 'employer_8';
    public const EMPLOYER_REFERENCE_9 = 'employer_9';

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('jp@gmail.com');
        $employer->setToken('jpToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
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
        $employer->setToken('marieToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
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
        $employer->setToken('leaToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
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
        $employer->setToken('pierreToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
        $employer->setFirstName('Pierre');
        $employer->setLastName('Curé');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_4, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('Katia@gmail.com');
        $employer->setToken('katiaToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
        $employer->setFirstName('Katia');
        $employer->setLastName('Sueur');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_5, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('Julien@gmail.com');
        $employer->setToken('julienToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
        $employer->setFirstName('Julien');
        $employer->setLastName('Quandt');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_6, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('george@gmail.com');
        $employer->setToken('georgeToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
        $employer->setFirstName('George');
        $employer->setLastName('Bouvier');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_7, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('Kris@gmail.com');
        $employer->setToken('krisToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
        $employer->setFirstName('Kris');
        $employer->setLastName('Helmer');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_8, $employer);

        $manager->persist($employer);
        $manager->flush();

        $employer = new Employer();
        $employer->setCreatedDate(new \DateTime());
        $employer->setLastModifiedDate(new \DateTime());
        $employer->setEmail('Sylvie@gmail.com');
        $employer->setToken('sylvieToken');
        $employer->setActive(true);
        $employer->setPassword($this->hasher->hashPassword($employer, 'password'));
        $employer->setRoles(['ROLE_EMPLOYER']);
        $employer->setFirstName('Sylvie');
        $employer->setLastName('Premier');
        $employer->setBirthdate(new \DateTime('2001-01-01'));
        $this->addReference(self::EMPLOYER_REFERENCE_9, $employer);

        $manager->persist($employer);
        $manager->flush();
    }
}
