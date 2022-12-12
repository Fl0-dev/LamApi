<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetApplicantLamatchProfileByCurrentApplicant extends AbstractController
{
    public function __invoke()
    {
        $applicant = $this->getUser();

        if (!$applicant instanceof Applicant) {
            throw new \Exception('Access denied');
        }

        $applicantLamatchProfile = $applicant->getApplicantSubscription()
            ->getLamatchSubscription()->getApplicantLamatchProfile();
        return $applicantLamatchProfile;
    }
}
