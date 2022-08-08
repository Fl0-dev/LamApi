<?php

namespace App\Controller;

use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountAllDepartments extends AbstractController
{
    public function __construct(private AddressRepository $addressRepository)
    {
    }
    
    public function __invoke()
    {
        return count($this->addressRepository->findAllDepartmentNumberWithAddress());
    }
}