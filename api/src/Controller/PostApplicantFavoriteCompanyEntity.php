<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Company\CompanyEntity;
use App\Entity\Subscriptions\Applicant\ApplicantCompany;
use App\Entity\Subscriptions\Applicant\ApplicantCompanySubscription;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantSubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostApplicantFavoriteCompanyEntity extends AbstractController
{
    public function __construct(
        private ApplicantSubscriptionRepository $applicantSubscriptionRepository,
    ) {
    }

    public function __invoke(Request $request): ApplicantCompany
    {
        $applicant = $this->getUser();

        if (!$applicant instanceof Applicant) {
            throw new BadRequestHttpException('Applicant not found');
        }

        $applicantCompany = $request->attributes->get('data');

        if (!$applicantCompany instanceof ApplicantCompany) {
            throw new BadRequestHttpException('ApplicantCompany not found');
        }

        if (!$applicantCompany->getCompanyEntity() instanceof CompanyEntity) {
            throw new BadRequestHttpException('CompanyEntity not found');
        }

        $applicantSubscription = $this->applicantSubscriptionRepository->findOneBy(['applicant' => $applicant]);

        $applicantCompanySubscription = $applicantSubscription->getCompanySubscription();

        if (!$applicantCompanySubscription instanceof ApplicantCompanySubscription) {
            $applicantCompanySubscription = new ApplicantCompanySubscription();

            $applicantSubscription->setCompanySubscription($applicantCompanySubscription);
        } else {
            if ($applicantCompanySubscription->getApplicantCompanies()->contains($applicantCompany)) {
                throw new BadRequestHttpException('ApplicantCompany already exists');
            }
            $applicantCompanySubscription->setLastModifiedDate(new \DateTime());
        }

        $applicantCompany->setApplicantCompanySubscription($applicantCompanySubscription);
        $applicantCompanySubscription->addApplicantCompany($applicantCompany);

        return $applicantCompany;
    }
}
