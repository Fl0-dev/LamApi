<?php

namespace App\Controller;

use App\Repository\LocationRepositories\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DepartmentAction extends AbstractController
{
    public const ENDPOINT_FOR_DEPARTMENT_COUNT_WITH_OFFICE = '_api_/departments-count_get';

    public function __construct(private AddressRepository $addressRepository)
    {
    }

    public function __invoke(Request $request): ?int
    {
        $endpoint = $request->attributes->get('_route');

        if ($endpoint === self::ENDPOINT_FOR_DEPARTMENT_COUNT_WITH_OFFICE) {
            return count($this->addressRepository->findAllCodeWithAddress());
        }

        return null;
    }
}
