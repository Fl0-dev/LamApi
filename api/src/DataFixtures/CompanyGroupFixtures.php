<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\CompanyEntity;
use App\Entity\CompanyEntityOffice;
use App\Entity\CompanyGroup;
use App\Entity\Media;
use App\Entity\MediaImage;
use App\Entity\MediaVideo;
use App\Entity\Profil;
use App\Entity\Social;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class  CompanyGroupFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMPANY_GROUP_REFERENCE_1 = 'company_group1';
    public const COMPANY_GROUP_REFERENCE_2 = 'company_group2';
    public const COMPANY_GROUP_REFERENCE_3 = 'company_group3';
    public const COMPANY_GROUP_REFERENCE_4 = 'company_group4';

    public const COMPANY_ENTITY_REFERENCE_1 = 'company_entity1';
    public const COMPANY_ENTITY_REFERENCE_2 = 'company_entity2';
    public const COMPANY_ENTITY_REFERENCE_3 = 'company_entity3';
    public const COMPANY_ENTITY_REFERENCE_4 = 'company_entity4';

    public function load(ObjectManager $manager)
    {
        ###### TGS FRANCE ######
        $social = new Social();
        $social->setFacebook('https://www.facebook.com/tgs-france');
        $social->setTwitter('https://twitter.com/tgs-france');

        $profil = new Profil();
        $profil->setCreationYear(2018);
        $profil->setSocial($social);
        $profil->setMiddleAge(35);
        $profil->setUsText('TGS France est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés partout en France.');

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfil($profil);
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
        $media->setType('image');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-header.png');
        $media->setSlug('tgs-france-header');
        $media->setType('image');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/tgs-france.mp4');
        $media->setSlug('tgs-france-video');
        $media->setType('video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Ouest');
        $companyEntity->setSlug('tgs-france-ouest');
        $this->addReference(self::COMPANY_ENTITY_REFERENCE_1, $companyEntity);
        
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

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        ###### EOLIS ######
        $social = new Social();
        $social->setFacebook('https://www.facebook.com/Eolis');
        $social->setTwitter('https://twitter.com/Eolis');

        $profil = new Profil();
        $profil->setSocial($social);
        $profil->setCreationYear(2015);
        $profil->setMiddleAge(41);
        $profil->setUsText('Eolis est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés à Nantes');

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfil($profil);
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
        $media->setType('image');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-header.png');
        $media->setSlug('eolis-header');
        $media->setType('image');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/eolis.mp4');
        $media->setSlug('eolis-video');
        $media->setType('video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

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
        $this->addReference(self::COMPANY_ENTITY_REFERENCE_2, $companyEntity);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('Eolis Nantes');
        $companyEntityOffice->setSlug('eolis-nantes');

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        ###### LIVLI ######
        $companyGroup = new CompanyGroup();
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
        $media->setType('image');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-header.png');
        $media->setSlug('livli-header');
        $media->setType('image');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/livli.mp4');
        $media->setSlug('livli-video');
        $media->setType('video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

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
        $this->addReference(self::COMPANY_ENTITY_REFERENCE_3, $companyEntity);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('Livli St Naz');
        $companyEntityOffice->setSlug('livli-st-naz');
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        ###### IN EXTENSO OUEST ######
        $companyGroup = new CompanyGroup();
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
        $media->setType('image');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-header.png');
        $media->setSlug('in-extenso-ouest-header');
        $media->setType('image');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/in-extenso-ouest.mp4');
        $media->setSlug('in-extenso-ouest-video');
        $media->setType('video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Ouest');
        $companyEntity->setSlug('In Extenso-ouest');
        $this->addReference(self::COMPANY_ENTITY_REFERENCE_4, $companyEntity);

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