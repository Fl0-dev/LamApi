<?php

namespace App\Controller;

use App\Repository\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CountCompanyGroupBadges extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }
    

    public function __invoke(Request $request)
    {
        $badges = $this->companyGroupRepository->find($request->get('id'))->getBadges();
        if(!$badges || !is_array($badges)){
            return 0;
        }

        return count($badges);
    }
}