<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\User\UserPhysical;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetLightCurrentApplicant extends AbstractController
{
    public function __invoke(Request $request): UserPhysical
    {
        $userPhysical = $this->getUser();

        if (!$userPhysical instanceof Applicant || $userPhysical->getId() != $request->get('id')) {
            throw new \Exception('Access denied');
        }

        return $userPhysical;
    }
}
