<?php

namespace App\DataFixtures;

use App\Entity\JobBoard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobBoardFixtures extends Fixture
{
    public const JOB_BOARD_REFERENCE_1 = 'jobBoard1';
    public const JOB_BOARD_REFERENCE_2 = 'jobBoard2';
    public const JOB_BOARD_REFERENCE_3 = 'jobBoard3';
    public const JOB_BOARD_REFERENCE_4 = 'jobBoard4';
    public const JOB_BOARD_REFERENCE_5 = 'jobBoard5';
    public const JOB_BOARD_REFERENCE_6 = 'jobBoard6';

    public function load(ObjectManager $manager)
    {
        $jobBoard = new JobBoard();
        $jobBoard->setName('Linkedin');
        $jobBoard->setSlug('linkedin');
        $jobBoard->setDescription('description de Linkedin');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_1, $jobBoard);
        $manager->persist($jobBoard);
        
        $jobBoard = new JobBoard();
        $jobBoard->setName('HelloWork');
        $jobBoard->setSlug('hellowork');
        $jobBoard->setDescription('description de HelloWork');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_2, $jobBoard);
        $manager->persist($jobBoard);
        
        $jobBoard = new JobBoard();
        $jobBoard->setName('MeteoJob');
        $jobBoard->setSlug('meteojob');
        $jobBoard->setDescription('description de MeteoJob');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_3, $jobBoard);
        $manager->persist($jobBoard);
        
        $jobBoard = new JobBoard();
        $jobBoard->setName('Apec');
        $jobBoard->setSlug('apec');
        $jobBoard->setDescription('description de Apec');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_4, $jobBoard);
        $manager->persist($jobBoard);
        
        $jobBoard = new JobBoard();
        $jobBoard->setName('Pôle Emploi');
        $jobBoard->setSlug('pole-emploi');
        $jobBoard->setDescription('description de Pôle Emploi');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_5, $jobBoard);
        $manager->persist($jobBoard);

        $jobBoard = new JobBoard();
        $jobBoard->setName('Indeed');
        $jobBoard->setSlug('indeed');
        $jobBoard->setDescription('description de Indeed');
        $jobBoard->setFree(true);
        $this->addReference(self::JOB_BOARD_REFERENCE_6, $jobBoard);
        $manager->persist($jobBoard);

        $manager->flush();
    }
}