<?php

namespace App\DataFixtures;

use App\Entity\Subscriptions\Employer\EmployerSubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmployerSubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_1));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_1)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_2));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_2)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_3));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_3)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_4));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_4)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_5));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_5)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_6));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_6)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_7));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_7)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_8));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_8)
        );

        $manager->persist($employerSubscription);
        $manager->flush();

        $employerSubscription = new EmployerSubscription();
        $employerSubscription->setCreatedDate(new \DateTime());
        $employerSubscription->setLastModifiedDate(new \DateTime());
        $employerSubscription->setEmployer($this->getReference(EmployerFixtures::EMPLOYER_REFERENCE_9));
        $employerSubscription->setLamatchSubscription(
            $this->getReference(EmployerLamatchSubscriptionFixtures::EMPLOYER_LAMATCH_SUBSCRIPTION_REFERENCE_9)
        );

        $manager->persist($employerSubscription);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EmployerLamatchSubscriptionFixtures::class,
            EmployerFixtures::class,
        ];
    }
}
