<?php

namespace App\Controller;

use App\Entity\Applicant\ApplicantCv;
use App\Entity\Application\Application;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Offer\Offer;
use App\Entity\References\ApplicationStatus;
use App\Repository\CompanyRepositories\CompanyEntityOfficeRepository;
use App\Repository\OfferRepositories\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class ApplicationController extends AbstractController
{
    public function __construct(
        private CompanyEntityOfficeRepository $companyEntityOfficeRepository,
        private OfferRepository $offerRepository
    ) {
    }


    public function __invoke(Request $request)
    {
        $operationName = $request->attributes->get('_api_item_operation_name');

        if (!$operationName) {
            $operationName = $request->attributes->get('_api_collection_operation_name');
        }

        if ($operationName === Application::OPERATION_NAME_PATH_POST_SPONTANEOUS_APPLICATION_BY_COMPANY_ENTITY_OFFICE_ID) {
            $companyEntityOfficeId = $request->attributes->get('companyEntityOfficeId');
            $file = $request->files->get('file');

            if (!$file instanceof File) {
                throw new \Exception('No file');
            }

            $motivation = $request->request->get('motivation');
            $companyEntityOffice = $this->companyEntityOfficeRepository->find($companyEntityOfficeId);

            if (!$companyEntityOffice instanceof CompanyEntityOffice || !$companyEntityOffice->hasId()) {
                throw new \Exception('companyEntity not found');
            }

            $application = new Application();
            $application->setMotivationText($motivation);
            $application->setcompanyEntityOffice($companyEntityOffice);

            $applicantCV = new ApplicantCv();
            $applicantCV->setFile($file);
            $applicantCV->setCreatedDate(new \DateTime());

            $application->setCv($applicantCV);
            $application->setCreatedDate(new \DateTime());
            $application->setLastModifiedDate(new \DateTime());
            $application->setStatus(ApplicationStatus::NEW);

            return $application;
        }

        if ($operationName === Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID) {
            $offerId = $request->attributes->get('offerId');
            $file = $request->files->get('file');

            if (!$file instanceof File) {
                throw new \Exception('No file');
            }

            $motivation = $request->request->get('motivationText');
            $offer = $this->offerRepository->find($offerId);

            if (!$offer instanceof Offer || !$offer->hasId()) {
                throw new \Exception('Offer not found');
            }

            $application = new Application();
            $application->setMotivationText($motivation);
            $application->setOffer($offer);
            
            $applicantCV = new ApplicantCv();
            $applicantCV->setFile($file);
            $applicantCV->setCreatedDate(new \DateTime());

            $application->setCv($applicantCV);
            $application->setCreatedDate(new \DateTime());
            $application->setLastModifiedDate(new \DateTime());
            $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
            $application->setCompanyEntityOffice($offer->getCompanyEntityOffice());
            $offer->addApplication($application);

            return $application;
        }

        return null;
    }
}
