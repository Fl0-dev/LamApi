<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatch;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Service\ApplicantLamatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetApplicantLamatchResults extends AbstractController
{
    public function __construct(
        private ApplicantLamatchService $applicantLamatchService,
    ) {
    }

    public function __invoke()
    {
        $applicant = $this->getUser();
        if (!$applicant instanceof Applicant) {
            throw new \Exception('User is not an applicant');
        }

        $applicantLamatchSubscription = $applicant->getApplicantSubscription()->getLamatchSubscription();
        if (
            !$applicantLamatchSubscription instanceof ApplicantLamatchSubscription
            || !$applicantLamatchSubscription->getStatus() === SubscriptionStatus::ACTIVE
            || !$applicantLamatchSubscription->getApplicantLamatchProfile() instanceof ApplicantLamatchProfile
        ) {
            throw new \Exception('User has no active lamatch subscription');
        }
        $applicantLamatch = new ApplicantLamatch();
        $applicantLamatch->setLamatchSubscription($applicantLamatchSubscription);

        $companyResults = $this->applicantLamatchService->getCompanyResults($applicantLamatchSubscription, $applicantLamatch);
    }
}
