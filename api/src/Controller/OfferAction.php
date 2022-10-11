<?php

namespace App\Controller;

use App\Entity\Offer\Offer;
use App\Transversal\Slug;
use App\Repository\OfferRepositories\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class OfferAction extends AbstractController
{
    public function __construct(private OfferRepository $offerRepository)
    {
    }

    public function __invoke(Request $request): null|int|Offer
    {
        $operationName = $request->attributes->get('_api_item_operation_name');

        if (!$operationName) {
            $operationName = $request->attributes->get('_api_collection_operation_name');
        }

        if ($operationName === Offer::OPERATION_NAME_COUNT_OFFERS) {
            $count = count($this->offerRepository->findAll());

            if (!$count) {
                return 0;
            }

            return $count;
        }

        if ($operationName === Offer::OPERATION_NAME_POST_OFFER) {
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
