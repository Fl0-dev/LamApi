<?php

namespace App\Controller;

use App\Entity\ApplicantCv;
use App\Entity\Application;
use App\Entity\Repositories\ApplicationStatus;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class PostApplicationByOfferId extends AbstractController
{

    public function __construct(private OfferRepository $offerRepository)
    {
    }

    public function __invoke(Request $request)
    {
        $offerId = $request->attributes->get('offerId');
        $file = $request->files->get('file');
        if (!$file instanceof File) {
            throw new \Exception('No file');
        }
    
        $motivation = $request->request->get('motivation');
        $offer = $this->offerRepository->find($offerId);
        if (!$offer) {
            throw new \Exception('Offer not found');
        }
        $application = new Application();
        $application->setMotivation($motivation);
        $application->setOffer($offer);

        $applicantCV = new ApplicantCv();
        $applicantCV->setFile($file);
        $applicantCV->setCreatedDate(new \DateTime());
        $applicantCV->setLastModifiedDate(new \DateTime());

        $application->setCv($applicantCV);
        $application->setCreatedDate(new \DateTime());
        $application->setLastModifiedDate(new \DateTime());
        $application->setStatus(ApplicationStatus::NEW);
        $application->setCompanyEntityOffice($offer->getCompanyEntityOffice());
        $offer->addApplication($application);

        return $application;
    }
}