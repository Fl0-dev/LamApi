<?php

namespace App\Controller;

use App\Repository\CompanyEntityRepository;
use App\Repository\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CountCompanyGroupOffers extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository, private CompanyEntityRepository $companyEntityRepository)
    {
    }
    
    public function __invoke(Request $request)
    {
        $companyEntities = $this->companyGroupRepository->find($request->get('id'))->getCompanyEntities();
        $count = 0;

        foreach ($companyEntities as $companyEntity) {
            $count += count($companyEntity->getOffers());
        }

        return $count;
    }
}