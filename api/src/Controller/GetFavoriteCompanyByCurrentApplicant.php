<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Subscriptions\Applicant\ApplicantCompany;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantCompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetFavoriteCompanyByCurrentApplicant extends AbstractController
{
    public function __construct(private ApplicantCompanyRepository $applicantCompanyRepository)
    {
    }

    public function __invoke(Request $request)
    {
        $applicant = $this->getUser();

        if (!$applicant instanceof Applicant) {
            throw new \Exception('Access denied');
        }

        $applicantCompanyId = $request->get('id');

        $applicantCompany = $this->applicantCompanyRepository->find($applicantCompanyId);

        if (!$applicantCompany instanceof ApplicantCompany) {
            throw new \Exception('Applicant company not found');
        }

        $applicantFavoriteCompanies =
            $applicant->getApplicantSubscription()->getCompanySubscription()->getApplicantCompanies();


        if (!$applicantFavoriteCompanies->contains($applicantCompany)) {
            throw new \Exception('Access denied');
        }

        return $applicantCompany;
    }
}
