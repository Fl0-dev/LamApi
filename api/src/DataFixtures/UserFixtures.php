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

    public const USER_ABSTRACT_REFERENCE_1 = 'user_abstract_1';
    public const USER_ABSTRACT_REFERENCE_2 = 'user_abstract_2';
    public const USER_ABSTRACT_REFERENCE_3 = 'user_abstract_3';
    public const USER_ABSTRACT_REFERENCE_4 = 'user_abstract_4';
    public const USER_ABSTRACT_REFERENCE_5 = 'user_abstract_5';
    public const USER_ABSTRACT_REFERENCE_6 = 'user_abstract_6';
    public const USER_ABSTRACT_REFERENCE_7 = 'user_abstract_7';
    public const USER_ABSTRACT_REFERENCE_8 = 'user_abstract_8';

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

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('digital-recruiters@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('Digital Recruiters');
        $userAbstract->setSlug('digital-recruiters');
        $userAbstract->setcontactEmail('contact@digital-recruiters.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_1, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('flatchr@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('Flatchr');
        $userAbstract->setSlug('flatchr');
        $userAbstract->setcontactEmail('contact@flatchr.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_2, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('rhprofiler@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('RhProfiler');
        $userAbstract->setSlug('rhprofiler');
        $userAbstract->setcontactEmail('contact@rhprofiler.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_3, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('taleez@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('Taleez');
        $userAbstract->setSlug('taleez');
        $userAbstract->setcontactEmail('contact@taleez.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_4, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('talentdetection@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('TalentDetection');
        $userAbstract->setSlug('talentdetection');
        $userAbstract->setcontactEmail('contact@talentdetection.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_5, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('talentplug@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('TalentPlug');
        $userAbstract->setSlug('talentplug');
        $userAbstract->setcontactEmail('contact@talentplug.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_6, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('teamtailor@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('Teamtailor');
        $userAbstract->setSlug('teamtailor');
        $userAbstract->setcontactEmail('contact@teamtailor.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_7, $userAbstract);

        $manager->persist($userAbstract);
        $manager->flush();

        $userAbstract = new UserAbstract();
        $userAbstract->setCreatedDate(new \DateTime());
        $userAbstract->setLastModifiedDate(new \DateTime());
        $userAbstract->setEmail('werecruit@gmail.com');
        $userAbstract->setPassword($this->hasher->hashPassword($userAbstract, 'password'));
        $userAbstract->setName('WeRecruit');
        $userAbstract->setSlug('werecruit');
        $userAbstract->setcontactEmail('contact@werecruit.com');
        $userAbstract->setcontactPhone('0123456789');
        $this->addReference(self::USER_ABSTRACT_REFERENCE_8, $userAbstract);

        $manager->persist($userAbstract);
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