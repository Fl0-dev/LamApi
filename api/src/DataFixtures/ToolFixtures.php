<?php

namespace App\DataFixtures;

use App\Entity\MediaImage;
use App\Entity\Tool;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ToolFixtures extends Fixture
{
    public const TOOL_REFERENCE_1 = 'tool1';
    public const TOOL_REFERENCE_2 = 'tool2';
    public const TOOL_REFERENCE_3 = 'tool3';

    public function load(ObjectManager $manager)
    {
        $tool = new Tool();
        $tool->setLabel('Teams');
        $tool->setSlug('teams');

        $media = new MediaImage();
        $media->setContentUrl('https://www.teams.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/teams-logo.png');
        $media->setSlug('teams-logo');
        $media->setType('image');

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_1, $tool);

        $tool = new Tool();
        $tool->setLabel('Dext');
        $tool->setSlug('dext');

        $media = new MediaImage();
        $media->setContentUrl('https://www.dext.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/dext-logo.png');
        $media->setSlug('dext-logo');
        $media->setType('image');

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_2, $tool);


        $tool = new Tool();
        $tool->setLabel('Fygr');
        $tool->setSlug('fygr');

        $media = new MediaImage();
        $media->setContentUrl('https://www.fygr.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/fygr-logo.png');
        $media->setSlug('fygr-logo');
        $media->setType('image');

        $tool->setLogo($media);
        $this->addReference(self::TOOL_REFERENCE_3, $tool);
        $manager->persist($tool);

        $manager->flush();
    }
}
