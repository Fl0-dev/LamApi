<?php

namespace App\DataFixtures;

use App\Entity\User\UserAdmin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    public const ADMIN_REFERENCE_1 = 'admin_1';
    public const ADMIN_REFERENCE_LAMADASH = 'admin_lamadash';

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $userAdmin = new UserAdmin();
        $userAdmin->setCreatedDate(new \DateTime());
        $userAdmin->setLastModifiedDate(new \DateTime());
        $userAdmin->setEmail('admin@gmail.com');
        $userAdmin->setPassword($this->hasher->hashPassword($userAdmin, 'password'));
        $userAdmin->setFirstName('Admin');
        $userAdmin->setLastName('Admin');
        $userAdmin->setBirthdate(new \DateTime('1981-01-01'));
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setLevel('admin');
        $this->addReference(self::ADMIN_REFERENCE_1, $userAdmin);

        $manager->persist($userAdmin);
        $manager->flush();

        $userAdmin = new UserAdmin();
        $userAdmin->setCreatedDate(new \DateTime());
        $userAdmin->setLastModifiedDate(new \DateTime());
        $userAdmin->setEmail('lamadash@gmail.com');
        $userAdmin->setPassword($this->hasher->hashPassword($userAdmin, 'password'));
        $userAdmin->setFirstName('Lamadash');
        $userAdmin->setLastName('Lamadash');
        $userAdmin->setBirthdate(new \DateTime('2020-01-01'));
        $userAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $userAdmin->setLevel('super_admin');
        $this->addReference(self::ADMIN_REFERENCE_LAMADASH, $userAdmin);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
