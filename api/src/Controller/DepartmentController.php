<?php

namespace App\Controller;

use App\Entity\Location\Department;
use App\Repository\LocationRepositories\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DepartmentController extends AbstractController
{
    public function __construct(private AddressRepository $addressRepository)
    {
    }
    
    public function __invoke(Request $request)
    {
        $operationName = $request->attributes->get('_api_item_operation_name');
        
        if (!$operationName) {
            $operationName = $request->attributes->get('_api_collection_operation_name');
        }

        if ($operationName === Department::OPERATION_NAME_COUNT_ALL_DEPARTMENTS_WITH_COMPANY) {
            return count($this->addressRepository->findAllDepartmentNumberWithAddress());
        }
    }
}