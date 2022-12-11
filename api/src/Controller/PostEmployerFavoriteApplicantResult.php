<?php

namespace App\Controller;

use App\Entity\Subscriptions\Employer\Lamatch\ApplicantResult;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerFavoriteCandidat;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\EmployerFavoriteCandidatRepository;
use App\Repository\SubscriptionRepositories\Employer\EmployerSubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostEmployerFavoriteApplicantResult extends AbstractController
{
    public function __construct(
        private EmployerSubscriptionRepository $employerSubscriptionRepository,
        private EmployerFavoriteCandidatRepository $employerFavoriteCandidatRepository,
    ) {
    }

    public function __invoke(Request $request): ?EmployerFavoriteCandidat
    {
        $employer = $this->getUser();

        if (!$employer instanceof Employer) {
            throw new \Exception('Employer not found');
        }

        $employerFavoriteCandidat = $request->get('data');
        $applicantResult = $employerFavoriteCandidat->getApplicantResult();

        if (!$applicantResult instanceof ApplicantResult) {
            throw new \Exception('ApplicantResult not found');
        }
        //TODO: factorize this code in a service
        $employerLamatchSubscriptionId = $applicantResult->getEmployerLamatch()
            ->getEmployerLamatchSubscription()->getId();

        $currentEmployerSubscription = $this->employerSubscriptionRepository->findOneBy([
            'employer' => $employer,
        ]);

        if (!$currentEmployerSubscription) {
            throw new \Exception('Employer subscription not found');
        }

        if (
            $employerLamatchSubscriptionId
            !== $currentEmployerSubscription->getLamatchSubscription()->getId()
        ) {
            throw new \Exception('ApplicantResult denied');
        }

        $ResearchEmployerFavoriteCandidat = $this->employerFavoriteCandidatRepository->findOneBy([
            'applicantResult' => $applicantResult,
            'employer' => $employer,
        ]);

        if ($ResearchEmployerFavoriteCandidat) {
            throw new \Exception('ApplicantResult already in favorite');
        }

        $employerFavoriteCandidat->setApplicantResult($applicantResult);
        $employerFavoriteCandidat->setEmployer($employer);

        return $employerFavoriteCandidat;
    }
}
