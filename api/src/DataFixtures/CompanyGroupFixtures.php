<?php

namespace App\DataFixtures;

use App\Entity\Location\Address;
use App\Entity\Company\CompanyEntity;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyGroup;
use App\Entity\Media\MediaImage;
use App\Entity\Media\MediaVideo;
use App\Entity\Company\CompanyProfile;
use App\Entity\Organisation;
use App\Entity\References\CompanySubscriptionType;
use App\Entity\References\Workforce;
use App\Entity\Social;
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

    public const COMPANY_ENTITY_OFFICE_REFERENCE_1 = 'company_entity_office1';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_2 = 'company_entity_office2';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_3 = 'company_entity_office3';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_4 = 'company_entity_office4';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_5 = 'company_entity_office5';
    public const COMPANY_ENTITY_OFFICE_REFERENCE_6 = 'company_entity_office6';

    public function load(ObjectManager $manager)
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
        $profile->setUsText('TGS France est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés partout en France.');
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('TGS France');
        $companyGroup->setSubscriptionType((new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId());
        $companyGroup->setSlug('tgs-france');
        $companyGroup->setCareerWebsite(false);
        $companyGroup->setColor('#ff0000');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $companyGroup->addPool($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_1));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_1, $companyGroup);

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
        
        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Ouest');
        $companyEntity->setSlug('tgs-france-ouest');

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
        $profile->setUsText('Eolis est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés à Nantes');
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('Eolis');
        $companyGroup->setSubscriptionType((new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId());
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
        $companyGroup->addPool($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_2));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_2, $companyGroup);

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

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### LIVLI ######

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_2, '10 à 19 salariés'))->getId());
        $profile->setCreationYear(2019);
        $profile->setMiddleAge(26);
        $profile->setUsText('Livli est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés à St Nazaire');
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_1));
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_2));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('Livli');
        $companyGroup->setSubscriptionType((new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId());
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
        $companyGroup->addPool($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_3));
        $companyGroup->addPartner($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_4));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_3, $companyGroup);

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
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Livli Ouest');
        $companyEntity->setSlug('livli-ouest');

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

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### IN EXTENSO OUEST ######

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_6, '200 à 499 salariés'))->getId());
        $profile->setCreationYear(2000);
        $profile->setMiddleAge(38);
        $profile->setUsText('In Extenso est un cabinet comptable spécialisé dans la gestion des entreprises. Nous sommes situés dans l\'Ouest');
        $profile->addTool($this->getReference(ToolFixtures::TOOL_REFERENCE_3));

        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($profile);
        $companyGroup->setCreatedDate(new \DateTime());
        $companyGroup->setLastModifiedDate(new \DateTime());
        $companyGroup->setName('In Extenso');
        $companyGroup->setSubscriptionType((new CompanySubscriptionType(CompanySubscriptionType::PREMIUM, 'Premium'))->getId());
        $companyGroup->setSlug('in-extenso');
        $companyGroup->setCareerWebsite(true);
        $companyGroup->setColor('#ff3333');
        $companyGroup->setOpenToRecruitment(true);
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $companyGroup->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_1));
        $companyGroup->addAts($this->getReference(AtsFixtures::ATS_REFERENCE_2));
        $companyGroup->addPartner($this->getReference(OrganisationFixtures::ORGANISATION_REFERENCE_5));
        $this->addReference(self::COMPANY_GROUP_REFERENCE_4, $companyGroup);

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
        
        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/header.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-header.png');
        $media->setSlug('in-extenso-ouest-header');
        $companyGroup->setHeaderMedia($media);
        
        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/videos/in-extenso-ouest.mp4');
        $media->setSlug('in-extenso-ouest-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);
        
        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/media1.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-media1.png');
        $media->setSlug('in-extenso-ouest-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/media2.png');
        $media->setCreatedDate(new \DateTime());
        $media->setLastModifiedDate(new \DateTime());
        $media->setFilePath('/assets/images/in-extenso-ouest-media2.png');
        $media->setSlug('in-extenso-ouest-media2');
        $companyGroup->addMedia($media);

        $companyEntity = new CompanyEntity();
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Ouest');
        $companyEntity->setSlug('in-Extenso-ouest');

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

        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrganisationFixtures::class,
            CityFixtures::class,
            JobTypeFixtures::class,
            ToolFixtures::class,
            BadgeFixtures::class,
        ];
    }
}
