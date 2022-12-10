<?php

namespace App\Controller;

use App\Entity\Subscriptions\Employer\Lamatch\ApplicantResult;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerFavoriteCandidat;
use App\Entity\User\Employer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostEmployerFavoriteApplicantResult extends AbstractController
{
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

        $employerFavoriteCandidat->setApplicantResult($applicantResult);
        $employerFavoriteCandidat->setEmployer($employer);

        return $employerFavoriteCandidat;
    }
}
