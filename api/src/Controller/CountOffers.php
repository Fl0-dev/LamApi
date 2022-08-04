<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountOffers extends AbstractController
{
    public function __construct(private OfferRepository $offerRepository)
    {
    }

    public function __invoke(): int
    {
        return count($this->offerRepository->findAll());
        
    }
}