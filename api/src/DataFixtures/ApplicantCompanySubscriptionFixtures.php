<?php

namespace App\DataFixtures;

use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\Applicant\ApplicantCompany;
use App\Entity\Subscriptions\Applicant\ApplicantCompanySubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicantCompanySubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_1 = 'applicant-company-subscription-1';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_2 = 'applicant-company-subscription-2';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_3 = 'applicant-company-subscription-3';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_4 = 'applicant-company-subscription-4';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_5 = 'applicant-company-subscription-5';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_6 = 'applicant-company-subscription-6';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_7 = 'applicant-company-subscription-7';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_8 = 'applicant-company-subscription-8';
    public const APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_9 = 'applicant-company-subscription-9';

    public function load(ObjectManager $manager)
    {
        // CompanySubscription for applicant 1
        $applicantCompanySubscription = new ApplicantCompanySubscription();
        $applicantCompanySubscription->setCreatedDate(new \DateTime());
        $applicantCompanySubscription->setLastModifiedDate(new \DateTime());
        $applicantCompanySubscription->setStatus(
            (
            new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_1, $applicantCompanySubscription);

        $manager->persist($applicantCompanySubscription);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_1));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_2));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_3));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();

        // CompanySubscription for applicant 2
        $applicantCompanySubscription = new ApplicantCompanySubscription();
        $applicantCompanySubscription->setCreatedDate(new \DateTime());
        $applicantCompanySubscription->setLastModifiedDate(new \DateTime());
        $applicantCompanySubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_2, $applicantCompanySubscription);

        $manager->persist($applicantCompanySubscription);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_1));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_2));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();

        // CompanySubscription for applicant 3
        $applicantCompanySubscription = new ApplicantCompanySubscription();
        $applicantCompanySubscription->setCreatedDate(new \DateTime());
        $applicantCompanySubscription->setLastModifiedDate(new \DateTime());
        $applicantCompanySubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_3, $applicantCompanySubscription);

        $manager->persist($applicantCompanySubscription);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_2));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();

        // CompanySubscription for applicant 4
        $applicantCompanySubscription = new ApplicantCompanySubscription();
        $applicantCompanySubscription->setCreatedDate(new \DateTime());
        $applicantCompanySubscription->setLastModifiedDate(new \DateTime());
        $applicantCompanySubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_4, $applicantCompanySubscription);

        $manager->persist($applicantCompanySubscription);
        $manager->flush();

        $applicantCompany = new ApplicantCompany();
        $applicantCompany->setCreatedDate(new \DateTime());
        $applicantCompany->setLastModifiedDate(new \DateTime());
        $applicantCompany->setActiveSending(true);
        $applicantCompany->setCompanyGroup($this->getReference(CompanyGroupFixtures::COMPANY_GROUP_REFERENCE_4));
        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);

        $manager->persist($applicantCompany);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CompanyGroupFixtures::class
        ];
    }
}
