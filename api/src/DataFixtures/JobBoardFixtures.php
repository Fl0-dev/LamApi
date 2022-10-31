<?php

namespace App\DataFixtures;

use App\Entity\User\UserJobBoard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class JobBoardFixtures extends Fixture
{
    public const JOB_BOARD_REFERENCE_1 = 'jobBoard1';
    public const JOB_BOARD_REFERENCE_2 = 'jobBoard2';
    public const JOB_BOARD_REFERENCE_3 = 'jobBoard3';
    public const JOB_BOARD_REFERENCE_4 = 'jobBoard4';
    public const JOB_BOARD_REFERENCE_5 = 'jobBoard5';
    public const JOB_BOARD_REFERENCE_6 = 'jobBoard6';

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $jobBoard = new UserJobBoard();
        $jobBoard->setCreatedDate(new \DateTime());
        $jobBoard->setLastModifiedDate(new \DateTime());
        $jobBoard->setEmail('linkedin@gmail.com');
        $jobBoard->setActive(true);
        $jobBoard->setPassword($this->hasher->hashPassword($jobBoard, 'password'));
        $jobBoard->setName('Linkedin');
        $jobBoard->setSlug('linkedin');
        $jobBoard->setcontactEmail('contact@linkedin.com');
        $jobBoard->setcontactPhone('0123456789');
        $jobBoard->setTokenLocal('tokenLocalLinkedIn');
        $jobBoard->setTokenQualification('tokenQualificationLinkedIn');
        $jobBoard->setTokenProduction('tokenProductionLinkedIn');
        $jobBoard->setDescription('description de Linkedin');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_1, $jobBoard);
        $manager->persist($jobBoard);

        $jobBoard = new UserJobBoard();
        $jobBoard->setCreatedDate(new \DateTime());
        $jobBoard->setLastModifiedDate(new \DateTime());
        $jobBoard->setEmail('hellowork@gmail.com');
        $jobBoard->setActive(true);
        $jobBoard->setPassword($this->hasher->hashPassword($jobBoard, 'password'));
        $jobBoard->setName('HelloWork');
        $jobBoard->setSlug('hellowork');
        $jobBoard->setcontactEmail('contact@hellowork.com');
        $jobBoard->setcontactPhone('0123456789');
        $jobBoard->setTokenLocal('tokenLocalHelloWork');
        $jobBoard->setTokenQualification('tokenQualificationHelloWork');
        $jobBoard->setTokenProduction('tokenProductionHelloWork');
        $jobBoard->setDescription('description de HelloWork');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_2, $jobBoard);
        $manager->persist($jobBoard);

        $jobBoard = new UserJobBoard();
        $jobBoard->setCreatedDate(new \DateTime());
        $jobBoard->setLastModifiedDate(new \DateTime());
        $jobBoard->setEmail('meteojob@gmail.com');
        $jobBoard->setActive(true);
        $jobBoard->setPassword($this->hasher->hashPassword($jobBoard, 'password'));
        $jobBoard->setName('MeteoJob');
        $jobBoard->setSlug('meteojob');
        $jobBoard->setcontactEmail('contact@meteojob.com');
        $jobBoard->setcontactPhone('0123456789');
        $jobBoard->setTokenLocal('tokenLocalMeteojob');
        $jobBoard->setTokenQualification('tokenQualificationMeteojob');
        $jobBoard->setTokenProduction('tokenProductionMeteojob');
        $jobBoard->setDescription('description de MeteoJob');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_3, $jobBoard);
        $manager->persist($jobBoard);

        $jobBoard = new UserJobBoard();
        $jobBoard->setCreatedDate(new \DateTime());
        $jobBoard->setLastModifiedDate(new \DateTime());
        $jobBoard->setEmail('apec@gmail.com');
        $jobBoard->setActive(true);
        $jobBoard->setPassword($this->hasher->hashPassword($jobBoard, 'password'));
        $jobBoard->setName('Apec');
        $jobBoard->setSlug('apec');
        $jobBoard->setcontactEmail('contact@apec.com');
        $jobBoard->setcontactPhone('0123456789');
        $jobBoard->setTokenLocal('tokenLocalApec');
        $jobBoard->setTokenQualification('tokenQualificationApec');
        $jobBoard->setTokenProduction('tokenProductionApec');
        $jobBoard->setDescription('description de Apec');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_4, $jobBoard);
        $manager->persist($jobBoard);

        $jobBoard = new UserJobBoard();
        $jobBoard->setCreatedDate(new \DateTime());
        $jobBoard->setLastModifiedDate(new \DateTime());
        $jobBoard->setEmail('pole-emploi@gmail.com');
        $jobBoard->setActive(true);
        $jobBoard->setPassword($this->hasher->hashPassword($jobBoard, 'password'));
        $jobBoard->setName('Pôle Emploi');
        $jobBoard->setSlug('pole-emploi');
        $jobBoard->setcontactEmail('contact@pole-emploi.com');
        $jobBoard->setcontactPhone('0123456789');
        $jobBoard->setTokenLocal('tokenLocalPoleEmploi');
        $jobBoard->setTokenQualification('tokenQualificationPoleEmploi');
        $jobBoard->setTokenProduction('tokenProductionPoleEmploi');
        $jobBoard->setDescription('description de Pôle Emploi');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_5, $jobBoard);
        $manager->persist($jobBoard);

        $jobBoard = new UserJobBoard();
        $jobBoard->setCreatedDate(new \DateTime());
        $jobBoard->setLastModifiedDate(new \DateTime());
        $jobBoard->setEmail('indeed@gmail.com');
        $jobBoard->setActive(true);
        $jobBoard->setPassword($this->hasher->hashPassword($jobBoard, 'password'));
        $jobBoard->setName('Indeed');
        $jobBoard->setSlug('indeed');
        $jobBoard->setcontactEmail('contact@indeed.com');
        $jobBoard->setcontactPhone('0123456789');
        $jobBoard->setTokenLocal('tokenLocalIndeed');
        $jobBoard->setTokenQualification('tokenQualificationIndeed');
        $jobBoard->setTokenProduction('tokenProductionIndeed');
        $jobBoard->setDescription('description de Indeed');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_6, $jobBoard);
        $manager->persist($jobBoard);

        $manager->flush();
    }
}
