<?php

namespace App\Controller;

use App\Entity\Subscriptions\Employer\EmployerSubscription;
use App\Entity\User\Employer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostEmployerSubscription extends AbstractController
{
    public function __invoke(Request $request): null|EmployerSubscription
    {
        $employer = $this->getUser();

        if (!$employer instanceof Employer) {
            throw new BadRequestHttpException('Employer not found');
        }

        $employerSubscription = $request->attributes->get('data');

        if (!$employerSubscription) {
            throw new BadRequestHttpException('Employer subscription not found');
        }

        $employerSubscription->setEmployer($employer);

        return $employerSubscription;
    }
}
