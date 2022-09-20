<?php

namespace App\DataFixtures;

use App\Entity\Media\MediaImage;
use App\Entity\Organisation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganisationFixtures extends Fixture
{
    public const ORGANISATION_REFERENCE_1 = 'organisation1';
    public const ORGANISATION_REFERENCE_2 = 'organisation2';
    public const ORGANISATION_REFERENCE_3 = 'organisation3';
    public const ORGANISATION_REFERENCE_4 = 'organisation4';
    public const ORGANISATION_REFERENCE_5 = 'organisation5';

    public function load(ObjectManager $manager)
    {
        $organisation = new Organisation();
        $organisation->setCreatedDate(new \DateTime());
        $organisation->setName('OrgaPourPool1');
        $organisation->setSlug('orgapourpool1');
        $organisation->setWebsite('https://www.orgapourpool1.com');

        $media = new MediaImage();
        $media->setContentUrl('https://www.orgapourpool1.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/orgapourpool1-logo.png');
        $media->setSlug('orgapourpool1-logo');
        $manager->persist($media);

        $organisation->setLogo($media);
        $manager->persist($organisation);
        $this->addReference(self::ORGANISATION_REFERENCE_1, $organisation);
        $manager->flush();

        $organisation = new Organisation();
        $organisation->setCreatedDate(new \DateTime());
        $organisation->setName('OrgaPourPool2');
        $organisation->setSlug('orgapourpool2');
        $organisation->setWebsite('https://www.orgapourpool2.com');

        $media = new MediaImage();
        $media->setContentUrl('https://www.orgapourpool2.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/orgapourpool2-logo.png');
        $media->setSlug('orgapourpool2-logo');
        $manager->persist($media);

        $organisation->setLogo($media);
        $manager->persist($organisation);
        $this->addReference(self::ORGANISATION_REFERENCE_2, $organisation);
        $manager->flush();

        $organisation = new Organisation();
        $organisation->setCreatedDate(new \DateTime());
        $organisation->setName('OrgaPourPool3');
        $organisation->setSlug('orgapourpool3');
        $organisation->setWebsite('https://www.orgapourpool3.com');

        $media = new MediaImage();
        $media->setContentUrl('https://www.orgapourpool3.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/orgapourpool3-logo.png');
        $media->setSlug('orgapourpool3-logo');
        $manager->persist($media);

        $organisation->setLogo($media);
        $manager->persist($organisation);
        $this->addReference(self::ORGANISATION_REFERENCE_3, $organisation);
        $manager->flush();

        $organisation = new Organisation();
        $organisation->setCreatedDate(new \DateTime());
        $organisation->setName('OrgaPourPartner1');
        $organisation->setSlug('orgapourpartner1');
        $organisation->setWebsite('https://www.orgapourpartner1.com');

        $media = new MediaImage();
        $media->setContentUrl('https://www.orgapourpartner1.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/orgapourpartner1-logo.png');
        $media->setSlug('orgapourpartner1-logo');
        $manager->persist($media);

        $organisation->setLogo($media);
        $manager->persist($organisation);
        $this->addReference(self::ORGANISATION_REFERENCE_4, $organisation);
        $manager->flush();

        $organisation = new Organisation();
        $organisation->setCreatedDate(new \DateTime());
        $organisation->setName('OrgaPourPartner2');
        $organisation->setSlug('orgapourpartner2');
        $organisation->setWebsite('https://www.orgapourpartner2.com');

        $media = new MediaImage();
        $media->setContentUrl('https://www.orgapourpartner2.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/orgapourpartner2-logo.png');
        $media->setSlug('orgapourpartner2-logo');
        $manager->persist($media);

        $organisation->setLogo($media);
        $manager->persist($organisation);
        $this->addReference(self::ORGANISATION_REFERENCE_5, $organisation);
        $manager->flush();
    }
}