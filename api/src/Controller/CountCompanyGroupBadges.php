<?php

namespace App\Controller;

use App\Repository\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

class CountCompanyGroupBadges extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }
    

    public function __invoke(Uuid $uuid)
    {
        $badges = $this->companyGroupRepository->find($uuid)->getBadges();
        if(!$badges || !is_array($badges)){
            return 0;
        }

        return count($badges);
    }
}