<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetApplicationsByCurrentApplicant extends AbstractController
{
    public function __invoke(Request $request): ?Collection
    {
        $applicant = $this->getUser();
        if (!$applicant instanceof Applicant) {
            throw new \Exception('Applicant not found');
        }

        return $applicant->getApplications();
    }
}
