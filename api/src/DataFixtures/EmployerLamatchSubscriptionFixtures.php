<?php

namespace App\DataFixtures;

use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchSubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployerLamatchSubscriptionFixtures extends Fixture
{
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1 = 'employer-lamatch-subscription-1';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_2 = 'employer-lamatch-subscription-2';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_3 = 'employer-lamatch-subscription-3';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_4 = 'employer-lamatch-subscription-4';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_5 = 'employer-lamatch-subscription-5';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_6 = 'employer-lamatch-subscription-6';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_7 = 'employer-lamatch-subscription-7';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_8 = 'employer-lamatch-subscription-8';
    public const EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_9 = 'employer-lamatch-subscription-9';

    public function load(ObjectManager $manager): void
    {
        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_2, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_3, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_4, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_5, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_6, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_7, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_8, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();

        $employerLamatchSubscription = new EmployerLamatchSubscription();
        $employerLamatchSubscription->setCreatedDate(new \DateTime());
        $employerLamatchSubscription->setLastModifiedDate(new \DateTime());
        $employerLamatchSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $this->addReference(self::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_9, $employerLamatchSubscription);

        $manager->persist($employerLamatchSubscription);
        $manager->flush();
    }
}
