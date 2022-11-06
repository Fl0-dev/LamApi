<?php

namespace App\DataFixtures;

use App\Entity\Media\MediaImage;
use App\Entity\Tool;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ToolFixtures extends Fixture
{
    public const TOOL_REFERENCE_1 = 'teams';
    public const TOOL_REFERENCE_2 = 'dext';
    public const TOOL_REFERENCE_3 = 'fygr';
    public const TOOL_REFERENCE_4 = 'rca';
    public const TOOL_REFERENCE_5 = 'pennylane';
    public const TOOL_REFERENCE_6 = 'tiime';
    public const TOOL_REFERENCE_7 = 'silae';
    public const TOOL_REFERENCE_8 = 'power-bi';
    public const TOOL_REFERENCE_9 = 'office-365';
    public const TOOL_REFERENCE_10 = 'eic';

    public function load(ObjectManager $manager): void
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
        $manager->persist($media);

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
        $manager->persist($media);

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
        $manager->persist($media);

        $tool->setLogo($media);
        $this->addReference(self::TOOL_REFERENCE_3, $tool);
        $manager->persist($tool);

        $tool = new Tool();
        $tool->setLabel('RCA');
        $tool->setSlug('rca');

        $media = new MediaImage();
        $media->setContentUrl('https://www.rca.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/rca-logo.png');
        $media->setSlug('rca-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_4, $tool);

        $tool = new Tool();
        $tool->setLabel('Pennylane');
        $tool->setSlug('pennylane');

        $media = new MediaImage();
        $media->setContentUrl('https://www.pennylane.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/pennylane-logo.png');
        $media->setSlug('pennylane-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_5, $tool);

        $tool = new Tool();
        $tool->setLabel('Tiime');
        $tool->setSlug('tiime');

        $media = new MediaImage();
        $media->setContentUrl('https://www.tiime.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tiime-logo.png');
        $media->setSlug('tiime-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_6, $tool);

        $tool = new Tool();
        $tool->setLabel('Silae');
        $tool->setSlug('silae');

        $media = new MediaImage();
        $media->setContentUrl('https://www.silae.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/silae-logo.png');
        $media->setSlug('silae-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_7, $tool);

        $tool = new Tool();
        $tool->setLabel('Power BI');
        $tool->setSlug('power-bi');

        $media = new MediaImage();
        $media->setContentUrl('https://www.power-bi.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/power-bi-logo.png');
        $media->setSlug('power-bi-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_8, $tool);

        $tool = new Tool();
        $tool->setLabel('Office 365');
        $tool->setSlug('office-365');

        $media = new MediaImage();
        $media->setContentUrl('https://www.office-365.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/office-365-logo.png');
        $media->setSlug('office-365-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_9, $tool);

        $tool = new Tool();
        $tool->setLabel('EIC');
        $tool->setSlug('eic');

        $media = new MediaImage();
        $media->setContentUrl('https://www.eic.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eic-logo.png');
        $media->setSlug('eic-logo');
        $manager->persist($media);

        $tool->setLogo($media);
        $manager->persist($tool);
        $this->addReference(self::TOOL_REFERENCE_10, $tool);

        $manager->flush();
    }
}
