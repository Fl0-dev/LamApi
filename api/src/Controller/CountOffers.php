<?php

namespace App\Controller;

use App\Repository\OfferRepositories\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountOffers extends AbstractController
{
    public function __construct(private OfferRepository $offerRepository)
    {
    }

    public function __invoke(): int
    {
        $count = count($this->offerRepository->findAll());
        if (!$count) {
            return 0;
        }
        return $count;
        
    }
}