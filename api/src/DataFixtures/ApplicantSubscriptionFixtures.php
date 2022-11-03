<?php

namespace App\DataFixtures;

use App\Entity\Subscriptions\Applicant\ApplicantSubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicantSubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // ApplicantSubscription for Applicant 1
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_1));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setOfferSubscription(
            $this->getReference(ApplicantOfferSubscriptionFixtures::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_1)
        );
        $applicantSubscription->setCompanySubscription(
            $this->getReference(ApplicantCompanySubscriptionFixtures::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_1)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 2
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_2));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setCompanySubscription(
            $this->getReference(ApplicantCompanySubscriptionFixtures::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_2)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 3
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_3));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setOfferSubscription(
            $this->getReference(ApplicantOfferSubscriptionFixtures::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_4)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 4
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_4));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setCompanySubscription(
            $this->getReference(ApplicantCompanySubscriptionFixtures::APPLICANT_COMPANY_SUBSCRIPTION_REFERENCE_3)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ApplicantFixtures::class,
            ApplicantOfferSubscriptionFixtures::class,
            ApplicantCompanySubscriptionFixtures::class,
        ];
    }
}
