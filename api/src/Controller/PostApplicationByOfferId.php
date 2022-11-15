<?php

namespace App\Controller;

use App\Entity\Applicant\ApplicantCv;
use App\Entity\Application\Application;
use App\Entity\Offer\Offer;
use App\Entity\References\ApplicationStatus;
use App\Repository\CompanyRepositories\CompanyEntityOfficeRepository;
use App\Repository\OfferRepositories\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class PostApplicationByOfferId extends AbstractController
{
    public const APPLICATION_PROPERTY_MOTIVATION_TEXT = 'motivationText';
    public const APPLICATION_PROPERTY_FILE = 'file';
    public const POST_APPLICATION_OFFER_IDENTIFIER_NAME = 'offerId';

    public function __construct(
        private CompanyEntityOfficeRepository $companyEntityOfficeRepository,
        private OfferRepository $offerRepository
    ) {
    }

    public function __invoke(Request $request): ?Application
    {
        $offerId = $request->attributes->get(self::POST_APPLICATION_OFFER_IDENTIFIER_NAME);
        $file = $request->files->get(self::APPLICATION_PROPERTY_FILE);

        if (!$file instanceof File) {
            throw new \Exception('No file');
        }

        $motivation = $request->request->get(self::APPLICATION_PROPERTY_MOTIVATION_TEXT);
        $offer = $this->offerRepository->find($offerId);

        if (!$offer instanceof Offer || !$offer->hasId()) {
            throw new \Exception('Offer not found');
        }

        $application = new Application();
        $application->setMotivationText((string) $motivation);
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
}
