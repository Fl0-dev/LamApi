<?php

namespace App\DataFixtures;

use App\Entity\Location\Address;
use App\Entity\Company\CompanyEntity;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Company\CompanyGroup;
use App\Entity\Media\MediaImage;
use App\Entity\Media\MediaVideo;
use App\Entity\References\CompanySubscriptionType;
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
        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_1));
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
        $media->setFilePath('/assets/images/tgs-france-logo.png');
        $media->setSlug('tgs-france-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/header.png');
        $media->setFilePath('/assets/images/tgs-france-header.png');
        $media->setSlug('tgs-france-header');
        $companyGroup->setHeaderMedia($media);


        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setFilePath('/assets/videos/tgs-france.mp4');
        $media->setSlug('tgs-france-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/tgs-france-media1.png');
        $media->setSlug('tgs-france-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/media2.png');
        $media->setFilePath('/assets/images/tgs-france-media2.png');
        $media->setSlug('tgs-france-media2');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france.com/assets/images/media3.png');
        $media->setFilePath('/assets/images/tgs-france-media3.png');
        $media->setSlug('tgs-france-media3');
        $companyGroup->addMedia($media);


        // CompanyEntity TGS France Ouest
        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_2));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Ouest');
        $companyEntity->setSlug('tgs-france-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_1));
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
        $media->setFilePath('/assets/images/tgs-france-ouest-media1.png');
        $media->setSlug('tgs-france-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france-ouest.com/assets/images/media2.png');
        $media->setFilePath('/assets/images/tgs-france-ouest-media2.png');
        $media->setSlug('tgs-france-ouest-media2');
        $companyEntity->addMedia($media);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_1, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        // CompanyEntity TGS France Est
        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_3));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('TGS France Est');
        $companyEntity->setSlug('tgs-france-est');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_1));
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_3));

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
        $media->setFilePath('/assets/images/tgs-france-est-media1.png');
        $media->setSlug('tgs-france-est-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.tgs-france-est.com/assets/images/media2.png');
        $media->setFilePath('/assets/images/tgs-france-est-media2.png');
        $media->setSlug('tgs-france-est-media2');
        $companyEntity->addMedia($media);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_2, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### EOLIS ######
        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_4));
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
        $media->setFilePath('/assets/images/eolis-logo.png');
        $media->setSlug('eolis-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/header.png');
        $media->setFilePath('/assets/images/eolis-header.png');
        $media->setSlug('eolis-header');
        $companyGroup->setHeaderMedia($media);


        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setFilePath('/assets/videos/eolis.mp4');
        $media->setSlug('eolis-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/eolis-media1.png');
        $media->setSlug('eolis-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis.com/assets/images/media2.png');
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
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_4));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Eolis Ouest');
        $companyEntity->setSlug('eolis-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_4));

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
        $media->setFilePath('/assets/images/eolis-ouest-media1.png');
        $media->setSlug('eolis-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.eolis-ouest.com/assets/images/media2.png');
        $media->setFilePath('/assets/images/eolis-ouest-media2.png');
        $media->setSlug('eolis-ouest-media2');
        $companyEntity->addMedia($media);

        $this->addReference(self::COMPANY_ENTITY_REFERENCE_3, $companyEntity);
        $manager->persist($companyEntity);

        $companyGroup->addCompanyEntity($companyEntity);

        $manager->persist($companyGroup);

        $manager->flush();

        ###### LIVLI ######
        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_5));
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
        $media->setFilePath('/assets/images/livli-logo.png');
        $media->setSlug('livli-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/header.png');
        $media->setFilePath('/assets/images/livli-header.png');
        $media->setSlug('livli-header');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setFilePath('/assets/videos/livli.mp4');
        $media->setSlug('livli-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/livli-media1.png');
        $media->setSlug('livli-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/media2.png');
        $media->setFilePath('/assets/images/livli-media2.png');
        $media->setSlug('livli-media2');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli.com/assets/images/media3.png');
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
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_5));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('Livli Ouest');
        $companyEntity->setSlug('livli-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli-ouest.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/livli-ouest-media1.png');
        $media->setSlug('livli-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.livli-ouest.com/assets/images/media2.png');
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
        $companyGroup = new CompanyGroup();
        $companyGroup->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_6));
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
        $media->setFilePath('/assets/images/in-extenso-logo.png');
        $media->setSlug('in-extenso-logo');
        $companyGroup->setLogo($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/header.png');
        $media->setFilePath('/assets/images/in-extenso-header.png');
        $media->setSlug('in-extenso-header');
        $companyGroup->setHeaderMedia($media);

        $media = new MediaVideo();
        $media->setContentUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $media->setFilePath('/assets/videos/in-extenso.mp4');
        $media->setSlug('in-extenso-video');
        $media->setAutoplay(true);
        $companyGroup->setMainMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/in-extenso-media1.png');
        $media->setSlug('in-extenso-media1');
        $companyGroup->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso.com/assets/images/media2.png');
        $media->setFilePath('/assets/images/in-extenso-media2.png');
        $media->setSlug('in-extenso-media2');
        $companyGroup->addMedia($media);

        //CompanyEntiy in Extenso ouest
        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_7));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Ouest');
        $companyEntity->setSlug('in-extenso-ouest');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_7));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/in-extenso-ouest-media1.png');
        $media->setSlug('in-extenso-ouest-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-ouest.com/assets/images/media2.png');
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
        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_8));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Metz');
        $companyEntity->setSlug('in-extenso-metz');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_8));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-metz.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/in-extenso-metz-media1.png');
        $media->setSlug('in-extenso-metz-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-metz.com/assets/images/media2.png');
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
        $companyEntity = new CompanyEntity();
        $companyEntity->setProfile($this->getReference(CompanyProfileFixtures::COMPANY_PROFILE_REFERENCE_9));
        $companyEntity->setCompanyGroup($companyGroup);
        $companyEntity->setName('In Extenso Châlons-en-Champagne');
        $companyEntity->setSlug('in-extenso-chalons-en-champagne');
        $companyEntity->setCreatedDate(new \DateTime());
        $companyEntity->setLastModifiedDate(new \DateTime());
        $companyEntity->addAdmin($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_9));

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-chalons-en-champagne.com/assets/images/media1.png');
        $media->setFilePath('/assets/images/in-extenso-chalons-en-champagne-media1.png');
        $media->setSlug('in-extenso-chalons-en-champagne-media1');
        $companyEntity->addMedia($media);

        $media = new MediaImage();
        $media->setContentUrl('https://www.in-extenso-chalons-en-champagne.com/assets/images/media2.png');
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
            CompanyProfileFixtures::class,
            EmployerFixtures::class,
            OrganisationFixtures::class,
            CityFixtures::class,
        ];
    }
}
