<?php

namespace App\DataFixtures;

use App\Entity\Location\Address;
use App\Entity\Company\CompanyEntity;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyGroup;
use App\Entity\Media\MediaImage;
use App\Entity\Media\MediaVideo;
use App\Entity\Company\CompanyProfile;
use App\Entity\References\CompanySubscriptionType;
use App\Entity\References\Workforce;
use App\Entity\SocialFeed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompanyGroupFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMPANY_GROUP_REFERENCE_1 = 'company_group1';
    public const COMPANY_GROUP_REFERENCE_2 = 'company_group2';
    public const COMPANY_GROUP_REFERENCE_3 = 'company_group3';
    public const COMPANY_GROUP_REFERENCE_4 = 'company_group4';

    public const COMPANY_ENTITY_REFERENCE_1 = 'company_entity1';
    public const COMPANY_ENTITY_REFERENCE_2 = 'company_entity2';
    public const COMPANY_ENTITY_REFERENCE_3 = 'company_entity3';
    public const COMPANY_ENTITY_REFERENCE_4 = 'company_entity4';
    public const COMPANY_ENTITY_REFERENCE_5 = 'company_entity5';
    public const COMPANY_ENTITY_REFERENCE_6 = 'company_entity6';
    public const COMPANY_ENTITY_REFERENCE_7 = 'company_entity7';

    public const COMPANY_ENTITY_OFFICE_REFERENCE_1 = 'company_entity_office1';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_2 = 'company_entity_office2';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_3 = 'company_entity_office3';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_4 = 'company_entity_office4';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_5 = 'company_entity_office5';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_6 = 'company_entity_office6';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_7 = 'company_entity_office7';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_8 = 'company_entity_office8';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_9 = 'company_entity_office9';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_10 = 'company_entity_office10';

    public function load(ObjectManager $manager): void
    {
        ###### TGS FRANCE ######
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/tgs-france');
        $socialFeed->setTwitter('https://twitter.com/tgs-france');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_8, '1000 à 1999 salariés'))->getId());
        $profile->setCreationYear(2018);
        $profile->setSocialFeed($socialFeed);
        $profile->setMiddleAge(35);
        $profile->setUsText(
            'TGS France est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés partout en France.'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AGROALIMENTAIRE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BTP));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_DISTRIBUTION));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('TGS France');
        $companyGroup->setSubscriptionType(
            (new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId()
        );
        $companyGroup->setSlug('tgs-france');
        $companyGroup->setCareerWebsite(false);
        $companyGroup->setColor('#ff0000');
        $companyGroup->setOpenToRecruitment(true);

        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $companyGroup->addPool($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_1));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_1, $companyGroup);

        $companyGroup->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_1));

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-logo.png');
        $media->setSlug('tgs-france-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-header.png');
        $media->setSlug('tgs-france-header');
        $companyGroup->setHeaderMedia($media);


        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/tgs-france.mp4');
        $media->setSlug('tgs-france-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-media1.png');
        $media->setSlug('tgs-france-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-media2.png');
        $media->setSlug('tgs-france-media2');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/media3.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-media3.png');
        $media->setSlug('tgs-france-media3');
        $companyGroup->addMedia($media);


        // CompanyEntity TGS France Ouest
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/tgs-france-ouest');
        $socialFeed->setTwitter('https://twitter.com/tgs-france-ouest');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_7, '500 à 999 salariés'))->getId());
        $profile->setCreationYear(2019);
        $profile->setSocialFeed($socialFeed);
        $profile->setMiddleAge(35);
        $profile->setUsText(
            'TGS France Ouest est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés dans l\'ouest.'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AGROALIMENTAIRE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BTP));

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Ouest');
        $companyEntity->setSlug('tgs-france-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_2));

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $address->setStreet('Rue de la Paix');
        $address->setName('TGS Nantes');
        $address->setPostalCode('44000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('TGS Nantes');
        $companyEntityOffice->setSlug('tgs-nantes');
        $companyEntityOffice->setHrMailAddress('TGSNantesRH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_1, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $address->setStreet('Rue du Port');
        $address->setName('TGS St Nazaire');
        $address->setPostalCode('44800');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('TGS St-Nazaire');
        $companyEntityOffice->setSlug('tgs-st-nazaire');
        $companyEntityOffice->setHrMailAddress('TGSStNazRH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_2, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france-ouest.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-ouest-media1.png');
        $media->setSlug('tgs-france-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france-ouest.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-ouest-media2.png');
        $media->setSlug('tgs-france-ouest-media2');
        $companyEntity->addMedia($media);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_1, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        // CompanyEntity TGS France Est
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/tgs-france-est');
        $socialFeed->setTwitter('https://twitter.com/tgs-france-est');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_7, '500 à 999 salariés'))->getId());
        $profile->setCreationYear(2019);
        $profile->setSocialFeed($socialFeed);
        $profile->setMiddleAge(35);
        $profile->setUsText(
            'TGS France Est est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés dans l\'est.'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_DISTRIBUTION));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE));

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Est');
        $companyEntity->setSlug('tgs-france-est');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_2));

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_5));
        $address->setStreet('Rue de la Paix');
        $address->setName('TGS Bar-le-Duc');
        $address->setPostalCode('55000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('TGS Bar-le-Duc');
        $companyEntityOffice->setSlug('tgs-bar-le-duc');
        $companyEntityOffice->setHrMailAddress('TGSBarRH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_10, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france-est.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-est-media1.png');
        $media->setSlug('tgs-france-est-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france-est.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/tgs-france-est-media2.png');
        $media->setSlug('tgs-france-est-media2');
        $companyEntity->addMedia($media);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_2, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### EOLIS ######
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/Eolis');
        $socialFeed->setTwitter('https://twitter.com/Eolis');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_3, '20 à 49 salariés'))->getId());
        $profile->setSocialFeed($socialFeed);
        $profile->setCreationYear(2015);
        $profile->setMiddleAge(41);
        $profile->setUsText(
            'Eolis est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés à Nantes'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_2));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_15));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PHARMACEUTIQUE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_MEDICAL));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INFORMATIQUE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_MEDIAS));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('Eolis');
        $companyGroup->setSubscriptionType(
            (new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId()
        );
        $companyGroup->setSlug('eolis');
        $companyGroup->setCareerWebsite(false);
        $companyGroup->setColor('#ff1111');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_3));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_5));
        $companyGroup->addPool($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_2));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_2, $companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-logo.png');
        $media->setSlug('eolis-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-header.png');
        $media->setSlug('eolis-header');
        $companyGroup->setHeaderMedia($media);


        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/eolis.mp4');
        $media->setSlug('eolis-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-media1.png');
        $media->setSlug('eolis-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-media2.png');
        $media->setSlug('eolis-media2');
        $companyGroup->addMedia($media);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_1));
        $address->setStreet('Rue de la Liberté');
        $address->setName('Eolis Nantes');
        $address->setPostalCode('44000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Eolis Ouest');
        $companyEntity->setSlug('eolis-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_3));


        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('Eolis Nantes');
        $companyEntityOffice->setSlug('eolis-nantes');
        $companyEntityOffice->setHrMailAddress('EolisRH@gmail.com');

        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_3, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis-ouest.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-ouest-media1.png');
        $media->setSlug('eolis-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis-ouest.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/eolis-ouest-media2.png');
        $media->setSlug('eolis-ouest-media2');
        $companyEntity->addMedia($media);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_3, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### LIVLI ######

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_2, '10 à 19 salariés'))->getId());
        $profile->setCreationYear(2019);
        $profile->setMiddleAge(26);
        $profile->setUsText(
            'Livli est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés à St Nazaire'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_1));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_2));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_8));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_9));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_2));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_14));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_13));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_ENERGIE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BTP));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_LOGISTIQUE));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('Livli');
        $companyGroup->setSubscriptionType(
            (new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId()
        );
        $companyGroup->setSlug('livli');
        $companyGroup->setCareerWebsite(true);
        $companyGroup->setColor('#ff2222');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_6));
        $companyGroup->addPool($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_3));
        $companyGroup->addPartner($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_4));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_3, $companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-logo.png');
        $media->setSlug('livli-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-header.png');
        $media->setSlug('livli-header');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/livli.mp4');
        $media->setSlug('livli-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-media1.png');
        $media->setSlug('livli-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-media2.png');
        $media->setSlug('livli-media2');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/media3.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-media3.png');
        $media->setSlug('livli-media3');
        $companyGroup->addMedia($media);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_2));
        $address->setStreet('Rue de la Liberté');
        $address->setName('Livli St Naz');
        $address->setPostalCode('44000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Livli Ouest');
        $companyEntity->setSlug('livli-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_4));

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli-ouest.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-ouest-media1.png');
        $media->setSlug('livli-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli-ouest.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/livli-ouest-media2.png');
        $media->setSlug('livli-ouest-media2');
        $companyEntity->addMedia($media);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('Livli St Naz');
        $companyEntityOffice->setSlug('livli-st-naz');
        $companyEntityOffice->setHrMailAddress('LivliRH@gmail.com');

        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_4, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_4, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### IN EXTENSO ######

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_6, '200 à 499 salariés'))->getId());
        $profile->setCreationYear(2000);
        $profile->setMiddleAge(38);
        $profile->setUsText(
            'In Extenso est un cabinet comptable spécialisé 
    dans la gestion des entreprises. Nous sommes situés en France.'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_8));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_9));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SOCIAL));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SPORT));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_COMMUNICATION));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC));
        $profile->addExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('In Extenso');
        $companyGroup->setSubscriptionType(
            (new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId()
        );
        $companyGroup->setSlug('in-extenso');
        $companyGroup->setCareerWebsite(true);
        $companyGroup->setColor('#ff3333');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $companyGroup->addPartner($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_5));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_4, $companyGroup);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/logo.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-logo.png');
        $media->setSlug('in-extenso-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-header.png');
        $media->setSlug('in-extenso-header');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/in-extenso.mp4');
        $media->setSlug('in-extenso-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-media1.png');
        $media->setSlug('in-extenso-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-media2.png');
        $media->setSlug('in-extenso-media2');
        $companyGroup->addMedia($media);

        //CompanyEntiy in Extenso ouest
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_5, '100 à 199 salariés'))->getId());
        $profile->setCreationYear(2000);
        $profile->setMiddleAge(38);
        $profile->setUsText(
            'In Extenso est un cabinet comptable spécialisé 
    dans la gestion des entreprises. Nous sommes situés dans l\'Ouest'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_4));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_8));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_9));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SOCIAL));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SPORT));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_COMMUNICATION));

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Ouest');
        $companyEntity->setSlug('in-extenso-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-media1.png');
        $media->setSlug('in-extenso-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-media2.png');
        $media->setSlug('in-extenso-ouest-media2');
        $companyEntity->addMedia($media);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_3));
        $address->setStreet('Rue de la Liberté');
        $address->setName('In Extenso Challans');
        $address->setPostalCode('44000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Challans');
        $companyEntityOffice->setSlug('in-extenso-challans');
        $companyEntityOffice->setHrMailAddress('InExtensoRH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_5, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_4));
        $address->setStreet('Rue de la Liberté');
        $address->setName('In Extenso Luçon');
        $address->setPostalCode('44000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Luçon');
        $companyEntityOffice->setSlug('in-extenso-lucon');
        $companyEntityOffice->setHrMailAddress('InExtensoRH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_6, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_5, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        //CompanyEntiy in Extenso Metz
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_5, '100 à 199 salariés'))->getId());
        $profile->setCreationYear(2000);
        $profile->setMiddleAge(38);
        $profile->setUsText(
            'In Extenso est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés à Metz'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC));
        $profile->addExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Metz');
        $companyEntity->setSlug('in-extenso-metz');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-metz.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-metz-media1.png');
        $media->setSlug('in-extenso-metz-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-metz.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-metz-media2.png');
        $media->setSlug('in-extenso-metz-media2');
        $companyEntity->addMedia($media);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_6));
        $address->setStreet('Rue de la Liberté');
        $address->setName('In Extenso Metz 1');
        $address->setPostalCode('57000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Metz 1');
        $companyEntityOffice->setSlug('in-extenso-metz-1');
        $companyEntityOffice->setHrMailAddress('InExtensoMetz1RH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_7, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_6));
        $address->setStreet('Rue de la Paix');
        $address->setName('In Extenso Metz 2');
        $address->setPostalCode('57000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Metz 2');
        $companyEntityOffice->setSlug('in-extenso-metz-2');
        $companyEntityOffice->setHrMailAddress('InExtensoMetz2RH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_8, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_6, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        //CompanyEntiy in Extenso Châlons-en-Champagne
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_5, '100 à 199 salariés'))->getId());
        $profile->setCreationYear(2000);
        $profile->setMiddleAge(38);
        $profile->setUsText(
            'In Extenso est un cabinet comptable spécialisé 
            dans la gestion des entreprises. Nous sommes situés à Châlons-en-Champagne'
        );
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_5));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_6));
        $profile->addBadge($this->getReference(BadgeFixtures::BADGE_REFERENCE_3));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC));
        $profile->addExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );

        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($profile);
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Châlons-en-Champagne');
        $companyEntity->setSlug('in-extenso-chalons-en-champagne');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-chalons-en-champagne.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-chalons-en-champagne-media1.png');
        $media->setSlug('in-extenso-chalons-en-champagne-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-chalons-en-champagne.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-chalons-en-champagne-media2.png');
        $media->setSlug('in-extenso-chalons-en-champagne');
        $companyEntity->addMedia($media);

        $address = new Address();
        $address->setCity($this->getReference(CityFixtures::CITY_REFERENCE_6));
        $address->setStreet('Rue de la Liberté');
        $address->setName('In Extenso Châlons-en-Champagne');
        $address->setPostalCode('51000');
        $address->setLatitude(47.218371);
        $address->setLongitude(-1.553621);

        $companyEntityOffice = new CompanyEntityOffice();
        $companyEntityOffice->setCompanyEntity($companyEntity);
        $companyEntityOffice->setAddress($address);
        $companyEntityOffice->setCreatedDate(new \DateTime());
        $companyEntityOffice->setLastModifiedDate(new \DateTime());
        $companyEntityOffice->setName('In Extenso Châlons-en-Champagne');
        $companyEntityOffice->setSlug('in-extenso-chalons-en-champagne');
        $companyEntityOffice->setHrMailAddress('InExtensoChalonRH@gmail.com');
        $this->addReference(self::COMPANY_ENTITY_OFFICE_REFERENCE_9, $companyEntityOffice);

        $companyEntity->addCompanyEntityOffice($companyEntityOffice);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_7, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ExpertiseFieldFixtures::class,
            EmployerFixtures::class,
            OrganisationFixtures::class,
            CityFixtures::class,
            JobTypeFixtures::class,
            ToolFixtures::class,
            BadgeFixtures::class,
        ];
    }
}
