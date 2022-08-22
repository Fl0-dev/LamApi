<?php

namespace App\Controller;

use App\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostApplicationByOfferId extends AbstractController
{
    public function __invoke(Request $request)
    {
        dd($request);
    }
}