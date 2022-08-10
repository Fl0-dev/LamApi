<?php

namespace App\Controller;

use App\Repository\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetCompanyGroupName extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }

    public function __invoke(Request $request)
    {
        $keywords = strtolower($request->get('keywords'));
        $keywords = trim($keywords);
        return $this->companyGroupRepository->findNameByPartial($keywords);
    }
}