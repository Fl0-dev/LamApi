<?php

namespace App\Controller;

use App\Repository\CompanyEntityRepository;
use App\Repository\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

class CountCompanyGroupOffers extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository, private CompanyEntityRepository $companyEntityRepository)
    {
    }
    
    public function __invoke(Uuid $uuid)
    {
        $count = 0;
        $companyEntities = $this->companyGroupRepository->find($uuid)->getCompanyEntities();
        if(!$companyEntities || !is_array($companyEntities)){
            return $count;
        }
        
        foreach($companyEntities as $companyEntity){
            $offers = $companyEntity->getOffers();
            if(!$offers || !is_array($offers)){
                continue;
            }
            $count += count($offers);
        }

        return $count;
    }
}