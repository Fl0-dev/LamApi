<?php

namespace App\Controller;

use App\Repository\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountCompanyGroups extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }

    public function __invoke(): int
    {
        return count($this->companyGroupRepository->findAll());
    }
}