<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Subscriptions\Applicant\ApplicantCompanySubscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetFavoriteCompaniesByCurrentApplicant extends AbstractController
{
    public function __invoke(): ApplicantCompanySubscription
    {
        $applicant = $this->getUser();

        if (!$applicant instanceof Applicant) {
            throw new \Exception('Access denied');
        }

        return $applicant->getApplicantSubscription()->getCompanySubscription();
    }
}
