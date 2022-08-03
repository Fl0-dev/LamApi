<?php

namespace App\Controller;

use App\Repository\CompanyEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

class OffersByCompanyEntityController extends AbstractController
{
    public function __construct(private CompanyEntityRepository $companyEntityRepository)
    {
    } 

    public function __invoke(Uuid $id)
    {
        return $this->companyEntityRepository->find($id)->getOffers();
    }
}