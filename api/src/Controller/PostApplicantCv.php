<?php

namespace App\Controller;

use App\Entity\Applicant\ApplicantCv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostApplicantCv extends AbstractController
{
    public function __invoke(Request $request): ApplicantCv
    {
        $uploadedFile = $request->files->get('cv');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"cv" is required');
        }

        $applicantCv = new ApplicantCv();
        $applicantCv->setFile($uploadedFile);
        $applicantCv->setCreatedDate(new \DateTime());

        return $applicantCv;
    }
}
