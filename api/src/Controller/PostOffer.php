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
        //TODO: récupération du user pour employer
        //TODO; récupération de l'ats
        if ($offer instanceof Offer) {
        $offer->setHeaderMedia($offer->getCompanyEntity()->getCompanyGroup()->getHeaderMedia());
        }
        return $offer;
    }
}