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
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_1)
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
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_2)
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
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_3)
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
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_4)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 5
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_5));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_5)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 6
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_6));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_6)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 7
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_7));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_7)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 8
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_8));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_8)
        );

        $manager->persist($applicantSubscription);
        $manager->flush();

        // ApplicantSubscription for Applicant 9
        $applicantSubscription = new ApplicantSubscription();
        $applicantSubscription->setApplicant($this->getReference(ApplicantFixtures::APPLICANT_REFERENCE_9));
        $applicantSubscription->setCreatedDate(new \DateTime());
        $applicantSubscription->setLastModifiedDate(new \DateTime());
        $applicantSubscription->setLamatchSubscription(
            $this->getReference(ApplicantLamatchProfileFixtures::APPLICANT_LAMATCH_SUBSCRIPTION_REFERENCE_9)
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
            ApplicantLamatchProfileFixtures::class,
        ];
    }
}
