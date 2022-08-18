<?php

namespace App\Controller;

use App\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostOffer extends AbstractController
{
    public function __invoke(Request $request)
    {
        $offer = $request->get('data');
        if ($offer instanceof Offer) {
        $offer->setHeaderMedia($offer->getCompanyEntity()->getCompanyGroup()->getHeaderMedia());
        }
        return $offer;
    }
}