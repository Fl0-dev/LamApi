<?php

namespace App\Controller;

use App\Entity\Subscriptions\Employer\Lamatch\ApplicantResult;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\EmployerSubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetDetailEmployerLamatchResultByResultId extends AbstractController
{
    public function __construct(
        private EmployerSubscriptionRepository $employerSubscriptionRepository,
    ) {
    }
    public function __invoke(Request $request)
    {
        $employer = $this->getUser();

        if (!$employer instanceof Employer) {
            throw new \Exception('User is not an employer');
        }

        $applicantResult = $request->attributes->get('data');

        if (!$applicantResult instanceof ApplicantResult) {
            throw new \Exception('Result is not an applicant result');
        }

        $employerSubscription = $this->employerSubscriptionRepository->findOneBy([
            'employer' => $employer,
        ]);

        if (
            $applicantResult->getEmployerLamatch()->getEmployerLamatchSubscription()->getId()
            !== $employerSubscription->getLamatchSubscription()->getId()
        ) {
            throw new \Exception('Employer is not the owner of this result');
        }
        dd($applicantResult->getId());
    }
}
