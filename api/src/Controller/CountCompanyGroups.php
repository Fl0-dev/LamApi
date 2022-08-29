<?php

namespace App\Controller;

use App\Repository\CompanyRepositories\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountCompanyGroups extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }

    public function __invoke(): int
    {
        $count = count($this->companyGroupRepository->findAll());
        if (!$count) {
            return 0;
        }
        return $count;
    }
}