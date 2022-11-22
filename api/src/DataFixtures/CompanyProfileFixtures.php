<?php

namespace App\DataFixtures;

use App\Entity\Company\CompanyProfile;
use App\Entity\References\Workforce;
use App\Entity\SocialFeed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompanyProfileFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMPANY_PROFILE_REFERENCE_1 = 'tgs-france';
    public const COMPANY_PROFILE_REFERENCE_2 = 'tgs-france-ouest';
    public const COMPANY_PROFILE_REFERENCE_3 = 'tgs-france-est';
    public const COMPANY_PROFILE_REFERENCE_4 = 'eolis';
    public const COMPANY_PROFILE_REFERENCE_5 = 'livli';
    public const COMPANY_PROFILE_REFERENCE_6 = 'in-extenso';
    public const COMPANY_PROFILE_REFERENCE_7 = 'in-extenso-ouest';
    public const COMPANY_PROFILE_REFERENCE_8 = 'in-extenso-metz';
    public const COMPANY_PROFILE_REFERENCE_9 = 'in-extenso-chalons';

    public function load(ObjectManager $manager): void
    {
        //Company 1 (TGS France)
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/tgs-france');
        $socialFeed->setTwitter('https://twitter.com/tgs-france');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_8, '1000 à 1999 salariés', 8))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_7));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_AGROALIMENTAIRE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BTP));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_DISTRIBUTION));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE));
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_1, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 2 (TGS FranceOuest)
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/tgs-france-ouest');
        $socialFeed->setTwitter('https://twitter.com/tgs-france-ouest');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_7, '500 à 999 salariés', 7))->getId());
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
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_2, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 3 (TGS FranceEst)
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/tgs-france-est');
        $socialFeed->setTwitter('https://twitter.com/tgs-france-est');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_7, '500 à 999 salariés', 7))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_7));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_3));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_DISTRIBUTION));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE));
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_3, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 4 (Eolis)
        $socialFeed = new SocialFeed();
        $socialFeed->setFacebook('https://www.facebook.com/Eolis');
        $socialFeed->setTwitter('https://twitter.com/Eolis');

        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_3, '20 à 49 salariés', 3))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_2));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_15));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PHARMACEUTIQUE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_MEDICAL));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INFORMATIQUE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_MEDIAS));
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_4, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 5 (Livli)
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_2, '10 à 19 salariés', 2))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_2));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_14));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_13));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_ENERGIE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_BTP));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_INDUSTRIE));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_LOGISTIQUE));
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_5, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 6 (InExtenso)
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_6, '200 à 499 salariés', 6))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SOCIAL));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SPORT));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_COMMUNICATION));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC));
        $profile->addExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_6, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 7 (InExtensoOuest)
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SOCIAL));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_SPORT));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_COMMUNICATION));
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_7, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 8 (InExtensoMetz)
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_8));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC));
        $profile->addExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_8, $profile);

        $manager->persist($profile);
        $manager->flush();

        //Company 9 (InExtensoChalons)
        $profile = new CompanyProfile();
        $profile->setWorkforce((new Workforce(Workforce::LEVEL_5, '100 à 199 salariés', 5))->getId());
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
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_0));
        $profile->addJobType($this->getReference(JobTypeFixtures::JOB_TYPE_REFERENCE_1));
        $profile->addExpertiseField($this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PUBLIC));
        $profile->addExpertiseField(
            $this->getReference(ExpertiseFieldFixtures::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES)
        );
        $this->addReference(self::COMPANY_PROFILE_REFERENCE_9, $profile);

        $manager->persist($profile);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ToolFixtures::class,
            BadgeFixtures::class,
            JobTypeFixtures::class,
            ExpertiseFieldFixtures::class,
        ];
    }
}
