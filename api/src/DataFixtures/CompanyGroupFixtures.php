<?php

namespace App\DataFixtures;

use App\Entity\Location\Address;
use App\Entity\Company\CompanyEntity;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyGroup;
use App\Entity\Media\MediaImage;
use App\Entity\Media\MediaVideo;
use App\Entity\Profile;
use App\Entity\References\Workforce;
use App\Entity\Social;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompanyGroupFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMPANY_GROUP_REFERENCE_1 = 'company_group1';
    public const COMPANY_GROUP_REFERENCE_2 = 'company_group2';
    public const COMPANY_GROUP_REFERENCE_3 = 'company_group3';
    public const COMPANY_GROUP_REFERENCE_4 = 'company_group4';

    public const COMPANY_ENTITY_OFFICE_REFERENCE_1 = 'company_entity_office1';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_2 = 'company_entity_office2';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_3 = 'company_entity_office3';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_4 = 'company_entity_office4';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_5 = 'company_entity_office5';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_6 = 'company_entity_office6';

    public function load(ObjectManager $manager)
    {
        ###### TGS FRANCE ######
        $social = new Social();
        $social->setFacebook('https://www.facebook.com/tgs-france');
        $social->setTwitter('https://twitter.com/tgs-france');

        $profile = new Profile();
        $profile->setWorkforce(Workforce::LEVEL_8);
        $profile->setCreationYear(2018);
        $profile->setSocial($social);
        $profile->setMiddleAge(35);
        $profile->setUsText('TGS France est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés partout en France.');

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('TGS France');
        $companyGroup->setSlug('tgs-france');
        $companyGroup->setCareerWebsite(false);
        $companyGroup->setColor('#ff0000');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_1, $companyGroup);

        $companyGroup->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $companyGroup->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));

        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_2));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-logo.png');
        $media->setSlug('tgs-france-logo');
        $companyGroup->setLogo($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-header.png');
        $media->setSlug('tgs-france-header');
        $companyGroup->setHeaderMedia($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/tgs-france.mp4');
        $media->setSlug('tgs-france-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);
        $media->setCompanyGroup($companyGroup);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Ouest');
        $companyEntity->setSlug('tgs-france-ouest');

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $address->setStreet('Rue de la Paix');
        $address->setName('TGS Nantes');
        $address->setPostalCode('44000');
        $address->setHrMailAddress('TGSNantesRH@gmail.com');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('TGS Nantes');
        $companyEntityOffice->setSlug('tgs-nantes');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_1, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $address->setStreet('Rue du Port');
        $address->setName('TGS St Nazaire');
        $address->setPostalCode('44800');
        $address->setHrMailAddress('TGSStNazRH@gmail.com');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('TGS St-Nazaire');
        $companyEntityOffice->setSlug('tgs-st-nazaire');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_2, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### EOLIS ######
        $social = new Social();
        $social->setFacebook('https://www.facebook.com/Eolis');
        $social->setTwitter('https://twitter.com/Eolis');

        $profile = new Profile();
        $profile->setWorkforce(Workforce::LEVEL_3);
        $profile->setSocial($social);
        $profile->setCreationYear(2015);
        $profile->setMiddleAge(41);
        $profile->setUsText('Eolis est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés à Nantes');

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('Eolis');
        $companyGroup->setSlug('eolis');
        $companyGroup->setCareerWebsite(false);
        $companyGroup->setColor('#ff1111');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_2));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_15));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_3));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_5));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_2, $companyGroup);

        $companyGroup->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));

        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-logo.png');
        $media->setSlug('eolis-logo');
        $companyGroup->setLogo($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-header.png');
        $media->setSlug('eolis-header');
        $companyGroup->setHeaderMedia($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/eolis.mp4');
        $media->setSlug('eolis-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);
        $media->setCompanyGroup($companyGroup);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $address->setStreet('Rue de la Liberté');
        $address->setName('Eolis Nantes');
        $address->setPostalCode('44000');
        $address->setHrMailAddress('EolisRH@gmail.com');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Eolis Ouest');
        $companyEntity->setSlug('eolis-ouest');


        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('Eolis Nantes');
        $companyEntityOffice->setSlug('eolis-nantes');

        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_3, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### LIVLI ######

        $profile = new Profile();
        $profile->setWorkforce(Workforce::LEVEL_2);
        $profile->setCreationYear(2019);
        $profile->setMiddleAge(26);
        $profile->setUsText('Livli est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés à St Nazaire');

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('Livli');
        $companyGroup->setSlug('livli');
        $companyGroup->setCareerWebsite(true);
        $companyGroup->setColor('#ff2222');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_2));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_14));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_13));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_6));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_3, $companyGroup);

        $companyGroup->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $companyGroup->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));

        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_2));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_8));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_9));

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-logo.png');
        $media->setSlug('livli-logo');
        $companyGroup->setLogo($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-header.png');
        $media->setSlug('livli-header');
        $companyGroup->setHeaderMedia($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/livli.mp4');
        $media->setSlug('livli-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);
        $media->setCompanyGroup($companyGroup);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $address->setStreet('Rue de la Liberté');
        $address->setName('Livli St Naz');
        $address->setPostalCode('44000');
        $address->setHrMailAddress('LivliRH@gmail.com');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Livli Ouest');
        $companyEntity->setSlug('livli-ouest');

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('Livli St Naz');
        $companyEntityOffice->setSlug('livli-st-naz');

        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_4, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### IN EXTENSO OUEST ######

        $profile = new Profile();
        $profile->setWorkforce(Workforce::LEVEL_6);
        $profile->setCreationYear(2000);
        $profile->setMiddleAge(38);
        $profile->setUsText('In Extenso est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés dans l\'Ouest');

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('In Extenso');
        $companyGroup->setSlug('in-extenso');
        $companyGroup->setCareerWebsite(true);
        $companyGroup->setColor('#ff3333');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_4, $companyGroup);

        $companyGroup->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));

        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_8));
        $companyGroup->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_9));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-logo.png');
        $media->setSlug('in-extenso-ouest-logo');
        $companyGroup->setLogo($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-header.png');
        $media->setSlug('in-extenso-ouest-header');
        $companyGroup->setHeaderMedia($media);
        $media->setCompanyGroup($companyGroup);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/in-extenso-ouest.mp4');
        $media->setSlug('in-extenso-ouest-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);
        $media->setCompanyGroup($companyGroup);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Ouest');
        $companyEntity->setSlug('In Extenso-ouest');

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_3));
        $address->setStreet('Rue de la Liberté');
        $address->setName('In Extenso Challans');
        $address->setPostalCode('44000');
        $address->setHrMailAddress('InExtensoRH@gmail.com');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Challans');
        $companyEntityOffice->setSlug('in-extenso-challans');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_5, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_4));
        $address->setStreet('Rue de la Liberté');
        $address->setName('In Extenso Luçon');
        $address->setPostalCode('44000');
        $address->setHrMailAddress('InExtensoRH@gmail.com');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Luçon');
        $companyEntityOffice->setSlug('in-extenso-lucon');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_6, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            JobTypeFixtures::class,
            ToolFixtures::class,
            BadgeFixtures::class,
        ];
    }
}