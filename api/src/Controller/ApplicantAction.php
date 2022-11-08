<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApplicantAction extends AbstractController
{
    public const OPERATION_NAME_POST_APPLICANT = '_api_/applicants_post';

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function __invoke(Request $request): Applicant|null
    {
        $endpoint = $request->attributes->get('_route');

        if ($endpoint === self::OPERATION_NAME_POST_APPLICANT) {
            $applicant = $request->attributes->get('data');

            if (!$applicant instanceof Applicant) {
                throw new \Exception('Applicant not found');
            }

            if (!Utils::isEMail($applicant->getEmail())) {
                throw new \Exception('Email is not valid');
            }

            $password = $applicant->getPassword();
            if (!Utils::isPassword($password)) {
                throw new \Exception('Password is invalid');
            }
            $applicant->setPassword($this->hasher->hashPassword($applicant, $password));

            return $applicant;
        }

        return null;
    }
}
