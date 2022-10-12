<?php

namespace App\Controller;

use App\Entity\Offer\Offer;
use App\Transversal\Slug;
use App\Repository\OfferRepositories\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class OfferAction extends AbstractController
{
    public const ENDPOINT_FOR_OFFER_COUNT= '_api_/offers-count_get';
    public const ENDPOINT_FOR_POST_OFFER = '_api_/offers_post';

    public function __construct(private OfferRepository $offerRepository)
    {
    }

    public function __invoke(Request $request): null|int|Offer
    {
        $endpoint = $request->attributes->get('_route');

        if ($endpoint === self::ENDPOINT_FOR_OFFER_COUNT) {
            $count = count($this->offerRepository->findAll());

            if (!$count) {
                return 0;
            }

            return $count;
        }

        if ($endpoint === self::ENDPOINT_FOR_POST_OFFER) {
            $offer = $request->get('data');
            //TODO: récupération du user pour employer
            //TODO; récupération de l'ats

            if ($offer instanceof Offer) {
                $offer->setHeaderMedia($offer->getCompanyEntityOffice()->getCompanyEntity()->getCompanyGroup()->getHeaderMedia());
                $offer->setSlug(Slug::getSlugifyString($offer->getTitle()));
            }

            return $offer;
        }

        return null;
    }
}
