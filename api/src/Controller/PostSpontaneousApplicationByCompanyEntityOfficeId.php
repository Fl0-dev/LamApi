<?php

namespace App\Controller;

use App\Entity\ApplicantCv;
use App\Entity\Application;
use App\Entity\Repositories\ApplicationStatus;
use App\Repository\CompanyEntityOfficeRepository;
use App\Repository\CompanyEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class PostSpontaneousApplicationByCompanyEntityOfficeId extends AbstractController
{
    public function __construct(private CompanyEntityOfficeRepository $companyEntityOfficeRepository)
    {
    }

    
    public function __invoke(Request $request)
    {
        $companyEntityOfficeId = $request->attributes->get('companyEntityOfficeId');
        $file = $request->files->get('file');
        if (!$file instanceof File) {
            throw new \Exception('No file');
        }
    
        $motivation = $request->request->get('motivation');
        $companyEntityOffice = $this->companyEntityOfficeRepository->find($companyEntityOfficeId);
        if (!$companyEntityOffice) {
            throw new \Exception('companyEntity not found');
        }
        $application = new Application();
        $application->setMotivation($motivation);
        $application->setcompanyEntityOffice($companyEntityOffice);
    
        $applicantCV = new ApplicantCv();
        $applicantCV->setFile($file);
        $applicantCV->setCreatedDate(new \DateTime());
        $applicantCV->setLastModifiedDate(new \DateTime());
    
        $application->setCv($applicantCV);
        $application->setCreatedDate(new \DateTime());
        $application->setLastModifiedDate(new \DateTime());
        $application->setStatus(ApplicationStatus::NEW);
        
    
        return $application;
    }
}