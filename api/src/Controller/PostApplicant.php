<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Repository\UserRepositories\UserRepository;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PostApplicant extends AbstractController
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(Request $request): Applicant|null
    {
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

        if (!preg_match('/^[\p{L} \'-]+$/u', $applicant->getFirstname())) {
            throw new \Exception('Firstname must not contain special characters and required');
        }

        if (!preg_match('/^[\p{L} \'-]+$/u', $applicant->getLastname())) {
            throw new \Exception('Lastname must not contain special characters and required');
        }

        $applicant->setPassword($this->hasher->hashPassword($applicant, $password));
        $applicant->setRoles(['ROLE_APPLICANT']);

        return $applicant;
    }
}
