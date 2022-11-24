<?php

namespace App\Controller;

use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchProfile;
use App\Entity\User\Employer;
use App\Repository\SubscriptionRepositories\Employer\EmployerSubscriptionRepository;
use App\Transversal\Slug;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostEmployerLamatchProfile extends AbstractController
{
    public function __construct(private EmployerSubscriptionRepository $employerSubscriptionRepository)
    {
    }

    public function __invoke(Request $request): null|EmployerLamatchProfile
    {
        $employer = $this->getUser();

        if (!$employer instanceof Employer) {
            throw new BadRequestHttpException('Employer not found');
        }
        $employerSubscription = $this->employerSubscriptionRepository->findOneBy(['employer' => $employer]);

        if (!$employerSubscription) {
            throw new BadRequestHttpException('Employer subscription not found');
        }
        $employerLamatchSubscription = $employerSubscription->getLamatchSubscription();

        if (!$employerLamatchSubscription) {
            throw new BadRequestHttpException('Employer lamatch subscription not found');
        }

        $lamatchProfile = $request->attributes->get('data');

        $lamatchProfile->setCompanyProfile($lamatchProfile->getCompanyEntityOffice()->getCompanyEntity()->getProfile());

        $lamatchProfile->setEmployerLamatchSubscription($employerLamatchSubscription);
        $lamatchProfile->setSlug(Slug::getSlugifyString($lamatchProfile->getLabel()));

        return $lamatchProfile;
    }
}
