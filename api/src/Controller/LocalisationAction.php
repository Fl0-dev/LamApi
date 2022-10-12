<?php

namespace App\Controller;

use App\Repository\LocationRepositories\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class LocalisationAction extends AbstractController
{
    public const ENDPOINT_FOR_LOCALISATION_BY_KEYWORDS = '_api_/localisations_get_collection';

    public function __construct(private AddressRepository $addressRepository)
    {
    }

    public function __invoke(Request $request): ?array
    {
        $endpoint = $request->attributes->get('_route');

        if ($endpoint === self::ENDPOINT_FOR_LOCALISATION_BY_KEYWORDS) {
            $keyWords = $request->query->get('keywords');

            return $this->addressRepository->localisationByKeyWords($keyWords);
        }

        return null;
    }
}
