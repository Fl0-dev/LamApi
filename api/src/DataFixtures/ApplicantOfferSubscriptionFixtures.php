<?php

namespace App\DataFixtures;

use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\Applicant\ApplicantOfferSubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicantOfferSubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_1 = 'applicant-offer-subscription-1';
    public const APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_2 = 'applicant-offer-subscription-2';
    public const APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_3 = 'applicant-offer-subscription-3';
    public const APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_4 = 'applicant-offer-subscription-4';
    public const APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_5 = 'applicant-offer-subscription-5';

    public function load(ObjectManager $manager)
    {
        $applicantOfferSubscription = new ApplicantOfferSubscription();
        $applicantOfferSubscription->setCreatedDate(new \DateTime());
        $applicantOfferSubscription->setLastModifiedDate(new \DateTime());
        $applicantOfferSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $applicantOfferSubscription->setOfferResearch(
            $this->getReference(OfferResearchFixtures::OFFER_RESEARCH_REFERENCE_1)
        );

        $this->addReference(self::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_1, $applicantOfferSubscription);
        $manager->persist($applicantOfferSubscription);
        $manager->flush();

        $applicantOfferSubscription = new ApplicantOfferSubscription();
        $applicantOfferSubscription->setCreatedDate(new \DateTime());
        $applicantOfferSubscription->setLastModifiedDate(new \DateTime());
        $applicantOfferSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $applicantOfferSubscription->setOfferResearch(
            $this->getReference(OfferResearchFixtures::OFFER_RESEARCH_REFERENCE_2)
        );

        $this->addReference(self::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_2, $applicantOfferSubscription);
        $manager->persist($applicantOfferSubscription);
        $manager->flush();

        $applicantOfferSubscription = new ApplicantOfferSubscription();
        $applicantOfferSubscription->setCreatedDate(new \DateTime());
        $applicantOfferSubscription->setLastModifiedDate(new \DateTime());
        $applicantOfferSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $applicantOfferSubscription->setOfferResearch(
            $this->getReference(OfferResearchFixtures::OFFER_RESEARCH_REFERENCE_3)
        );

        $this->addReference(self::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_3, $applicantOfferSubscription);
        $manager->persist($applicantOfferSubscription);
        $manager->flush();

        $applicantOfferSubscription = new ApplicantOfferSubscription();
        $applicantOfferSubscription->setCreatedDate(new \DateTime());
        $applicantOfferSubscription->setLastModifiedDate(new \DateTime());
        $applicantOfferSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $applicantOfferSubscription->setOfferResearch(
            $this->getReference(OfferResearchFixtures::OFFER_RESEARCH_REFERENCE_4)
        );

        $this->addReference(self::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_4, $applicantOfferSubscription);
        $manager->persist($applicantOfferSubscription);
        $manager->flush();

        $applicantOfferSubscription = new ApplicantOfferSubscription();
        $applicantOfferSubscription->setCreatedDate(new \DateTime());
        $applicantOfferSubscription->setLastModifiedDate(new \DateTime());
        $applicantOfferSubscription->setStatus(
            (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId()
        );
        $applicantOfferSubscription->setOfferResearch(
            $this->getReference(OfferResearchFixtures::OFFER_RESEARCH_REFERENCE_5)
        );

        $this->addReference(self::APPLICANT_OFFER_SUBSCRIPTION_REFERENCE_5, $applicantOfferSubscription);
        $manager->persist($applicantOfferSubscription);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OfferResearchFixtures::class,
        ];
    }
}
