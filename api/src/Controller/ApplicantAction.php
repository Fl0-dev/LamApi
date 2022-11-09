<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Repository\UserRepositories\UserRepository;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApplicantAction extends AbstractController
{
    public const OPERATION_NAME_POST_APPLICANT = '_api_/applicants_post';
    public const OPERATION_NAME_PUT_APPLICANT_WITH_PROFILE = '_api_/applicants/{id}_put';

    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private UserRepository $userRepository
    )
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

            if ($this->userRepository->findOneBy(['email' => $applicant->getEmail()])) {
                throw new \Exception('Email is already used');
            }

            $applicant->setPassword($this->hasher->hashPassword($applicant, $password));
            $applicant->setRoles(['ROLE_APPLICANT']);

            return $applicant;
        }

        if ($endpoint === self::OPERATION_NAME_PUT_APPLICANT_WITH_PROFILE) {
            $applicant = $request->attributes->get('data');
            dd($applicant);

            return $applicant;
        }

        return null;
    }
}
