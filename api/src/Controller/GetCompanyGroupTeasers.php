<?php

namespace App\Controller;

use App\Repository\CompanyGroupRepository;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetCompanyGroupTeasers extends AbstractController
{

    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }

    public function __invoke()
    {
        return $this->companyGroupRepository->findAll();
    }
}
