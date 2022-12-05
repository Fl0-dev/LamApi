<?php

namespace App\Controller;

use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatch;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchProfileRepository;
use App\Repository\SubscriptionRepositories\Employer\EmployerLamatchRepository;
use App\Repository\SubscriptionRepositories\Employer\EmployerSubscriptionRepository;
use App\Service\EmployerLamatchService;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetEmployerLamatchResultsByProfileId extends AbstractController
{
    public function __construct(
        private EmployerLamatchProfileRepository $employerLamatchProfileRepository,
        private EmployerSubscriptionRepository $employerSubscriptionRepository,
        private EmployerLamatchRepository $employerLamatchRepository,
        private EmployerLamatchService $employerLamatchService,
    ) {
    }

    public function __invoke(Request $request): array
    {
        $employer = $this->getUser();

        if (!$employer instanceof Employer) {
            throw new \Exception('User is not an employer');
        }

        $profileIdContent = json_decode($request->getContent(), true);
        $profileId = Utils::getArrayValue('profileId', $profileIdContent);

        $employerLamatchProfile = $this->employerLamatchProfileRepository->findOneBy([
            'id' => $profileId,
        ]);

        if (!$employerLamatchProfile) {
            throw new \Exception('Profile not found');
        }

        $employerSubscription = $this->employerSubscriptionRepository->findOneBy([
            'employer' => $employer,
        ]);

        if (!$employerSubscription) {
            throw new \Exception('Employer subscription not found');
        }

        if (
            $employerLamatchProfile->getEmployerLamatchSubscription()->getId()
            !== $employerSubscription->getLamatchSubscription()->getId()
        ) {
            throw new \Exception('Profile denied');
        }

        $employerLamatch = new EmployerLamatch();
        $employerLamatch->setEmployerLamatchSubscription($employerLamatchProfile->getEmployerLamatchSubscription());
        $employerLamatch->setEmployerLamatchProfile($employerLamatchProfile);
        $this->employerLamatchRepository->add($employerLamatch, true);

        $applicantResults =
            $this->employerLamatchService->getApplicantResults($employerLamatchProfile, $employerLamatch);

        return $applicantResults;
    }
}
