<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Subscriptions\Applicant\ApplicantCompany;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantCompanyRepository;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantCompanySubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DeleteApplicantFavoriteCompanyEntity extends AbstractController
{
    public function __construct(
        private ApplicantCompanyRepository $applicantCompanyRepository,
        private ApplicantCompanySubscriptionRepository $applicantCompanySubscriptionRepository,
    ) {
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
            throw new \Exception('Company is not or no longer in your favorites');
        }

        $companySubscription = $applicant->getApplicantSubscription()->getCompanySubscription();
        $companySubscription->removeApplicantCompany($applicantCompany);
        $companySubscription->setLastModifiedDate(new \DateTime());
        $this->applicantCompanyRepository->remove($applicantCompany, true);
        $this->applicantCompanySubscriptionRepository->add($companySubscription, true);
    }
}
