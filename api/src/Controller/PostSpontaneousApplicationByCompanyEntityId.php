<?php

namespace App\Controller;

use App\Entity\ApplicantCv;
use App\Entity\Application;
use App\Entity\Repositories\ApplicationStatus;
use App\Repository\CompanyEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class PostSpontaneousApplicationByCompanyEntityId extends AbstractController
{
    public function __construct(private CompanyEntityRepository $companyEntityRepository)
    {
    }

    
    public function __invoke(Request $request)
    {
        $companyEntityId = $request->attributes->get('companyEntityId');
        $file = $request->files->get('file');
        if (!$file instanceof File) {
            throw new \Exception('No file');
        }
    
        $motivation = $request->request->get('motivation');
        $companyEntity = $this->companyEntityRepository->find($companyEntityId);
        if (!$companyEntity) {
            throw new \Exception('companyEntity not found');
        }
        $application = new Application();
        $application->setMotivation($motivation);
        $application->setcompanyEntity($companyEntity);
    
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