<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Applicant\ApplicantCv;
use App\Entity\Application\Application;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\References\ApplicationStatus;
use App\Repository\CompanyRepositories\CompanyEntityOfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class PostSpontaneousApplication extends AbstractController
{
    public const APPLICATION_PROPERTY_MOTIVATION_TEXT = 'motivationText';
    public const APPLICATION_PROPERTY_FILE = 'cv';
    public const POST_APPLICATION_SPONTANEOUS_IDENTIFIER_NAME = 'companyEntityOfficeId';

    public function __construct(
        private CompanyEntityOfficeRepository $companyEntityOfficeRepository,
    ) {
    }

    public function __invoke(Request $request): ?Application
    {
        $applicant = $this->getUser();
        if (!$applicant instanceof Applicant) {
            throw new \Exception('Applicant not found');
        }

        $companyEntityOfficeId = $request->attributes->get(self::POST_APPLICATION_SPONTANEOUS_IDENTIFIER_NAME);
        $file = $request->files->get(self::APPLICATION_PROPERTY_FILE);
        if (!$file instanceof File) {
            throw new \Exception('No cv');
        }

        $motivation = $request->request->get(self::APPLICATION_PROPERTY_MOTIVATION_TEXT);
        $companyEntityOffice = $this->companyEntityOfficeRepository->find($companyEntityOfficeId);

        if (!$companyEntityOffice instanceof CompanyEntityOffice || !$companyEntityOffice->hasId()) {
            throw new \Exception('Office not found');
        }

        $application = new Application();
        $application->setIsSpontaneous(true);
        $application->setApplicant($applicant);
        $application->setMotivationText((string) $motivation);
        $application->setcompanyEntityOffice($companyEntityOffice);

        $applicantCV = new ApplicantCv();
        $applicantCV->setApplicant($applicant);
        $applicantCV->setFile($file);
        $applicantCV->setCreatedDate(new \DateTime());

        $application->setCv($applicantCV);
        $application->setCreatedDate(new \DateTime());
        $application->setLastModifiedDate(new \DateTime());
        $application->setStatus((new ApplicationStatus(ApplicationStatus::NEW, 'New'))->getId());
        $application->setApplicant($applicant);
        $companyEntityOffice->addApplication($application);

        return $application;
    }
}
