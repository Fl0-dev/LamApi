<?php

namespace App\DataFixtures;

use App\Entity\User\Employer;
use App\Entity\User\UserAdmin;
use App\Entity\User\UserAbstract;
use App\Entity\User\UserApi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const EMPLOYER_REFERENCE_1 = 'employer_1';
    public const EMPLOYER_REFERENCE_2 = 'employer_2';
    public const EMPLOYER_REFERENCE_3 = 'employer_3';
    public const EMPLOYER_REFERENCE_4 = 'employer_4';

    public const ADMIN_REFERENCE_1 = 'admin_1';
    public const ADMIN_REFERENCE_LAMADASH = 'admin_lamadash';

    public const USER_API_REFERENCE_1 = 'user_api_1';
    public const USER_API_REFERENCE_2 = 'user_api_2';
    public const USER_API_REFERENCE_3 = 'user_api_3';
    public const USER_API_REFERENCE_4 = 'user_api_4';
    public const USER_API_REFERENCE_5 = 'user_api_5';
    public const USER_API_REFERENCE_6 = 'user_api_6';

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

        $userApi = new UserApi();
        $userApi->setCreatedDate(new \DateTime());
        $userApi->setLastModifiedDate(new \DateTime());
        $userApi->setEmail('linkedin@gmail.com');
        $userApi->setPassword($this->hasher->hashPassword($userApi, 'password'));
        $userApi->setName('Linkedin');
        $userApi->setSlug('linkedin');
        $userApi->setcontactEmail('contact@linkedin.com');
        $userApi->setcontactPhone('0123456789');
        $userApi->setTokenLocal('tokenLocalLinkedIn');
        $userApi->setTokenQualification('tokenQualificationLinkedIn');
        $userApi->setTokenProduction('tokenProductionLinkedIn');
        $this->addReference(self::USER_API_REFERENCE_1, $userApi);

        $manager->persist($userApi);
        $manager->flush();

        $userApi = new UserApi();
        $userApi->setCreatedDate(new \DateTime());
        $userApi->setLastModifiedDate(new \DateTime());
        $userApi->setEmail('hellowork@gmail.com');
        $userApi->setPassword($this->hasher->hashPassword($userApi, 'password'));
        $userApi->setName('HelloWork');
        $userApi->setSlug('hellowork');
        $userApi->setcontactEmail('contact@hellowork.com');
        $userApi->setcontactPhone('0123456789');
        $userApi->setTokenLocal('tokenLocalHelloWork');
        $userApi->setTokenQualification('tokenQualificationHelloWork');
        $userApi->setTokenProduction('tokenProductionHelloWork');
        $this->addReference(self::USER_API_REFERENCE_2, $userApi);

        $manager->persist($userApi);
        $manager->flush();

        $userApi = new UserApi();
        $userApi->setCreatedDate(new \DateTime());
        $userApi->setLastModifiedDate(new \DateTime());
        $userApi->setEmail('meteojob@gmail.com');
        $userApi->setPassword($this->hasher->hashPassword($userApi, 'password'));
        $userApi->setName('MeteoJob');
        $userApi->setSlug('meteojob');
        $userApi->setcontactEmail('contact@meteojob.com');
        $userApi->setcontactPhone('0123456789');
        $userApi->setTokenLocal('tokenLocalMeteojob');
        $userApi->setTokenQualification('tokenQualificationMeteojob');
        $userApi->setTokenProduction('tokenProductionMeteojob');
        $this->addReference(self::USER_API_REFERENCE_3, $userApi);

        $manager->persist($userApi);
        $manager->flush();

        $userApi = new UserApi();
        $userApi->setCreatedDate(new \DateTime());
        $userApi->setLastModifiedDate(new \DateTime());
        $userApi->setEmail('apec@gmail.com');
        $userApi->setPassword($this->hasher->hashPassword($userApi, 'password'));
        $userApi->setName('Apec');
        $userApi->setSlug('apec');
        $userApi->setcontactEmail('contact@apec.com');
        $userApi->setcontactPhone('0123456789');
        $userApi->setTokenLocal('tokenLocalApec');
        $userApi->setTokenQualification('tokenQualificationApec');
        $userApi->setTokenProduction('tokenProductionApec');
        $this->addReference(self::USER_API_REFERENCE_4, $userApi);

        $manager->persist($userApi);
        $manager->flush();

        $userApi = new UserApi();
        $userApi->setCreatedDate(new \DateTime());
        $userApi->setLastModifiedDate(new \DateTime());
        $userApi->setEmail('pole-emploi@gmail.com');
        $userApi->setPassword($this->hasher->hashPassword($userApi, 'password'));
        $userApi->setName('Pôle Emploi');
        $userApi->setSlug('pole-emploi');
        $userApi->setcontactEmail('contact@pole-emploi.com');
        $userApi->setcontactPhone('0123456789');
        $userApi->setTokenLocal('tokenLocalPoleEmploi');
        $userApi->setTokenQualification('tokenQualificationPoleEmploi');
        $userApi->setTokenProduction('tokenProductionPoleEmploi');
        $this->addReference(self::USER_API_REFERENCE_5, $userApi);

        $manager->persist($userApi);
        $manager->flush();

        $userApi = new UserApi();
        $userApi->setCreatedDate(new \DateTime());
        $userApi->setLastModifiedDate(new \DateTime());
        $userApi->setEmail('indeed@gmail.com');
        $userApi->setPassword($this->hasher->hashPassword($userApi, 'password'));
        $userApi->setName('Indeed');
        $userApi->setSlug('indeed');
        $userApi->setcontactEmail('contact@indeed.com');
        $userApi->setcontactPhone('0123456789');
        $userApi->setTokenLocal('tokenLocalIndeed');
        $userApi->setTokenQualification('tokenQualificationIndeed');
        $userApi->setTokenProduction('tokenProductionIndeed');
        $this->addReference(self::USER_API_REFERENCE_6, $userApi);

        $manager->persist($userApi);
        $manager->flush();
    }
}
