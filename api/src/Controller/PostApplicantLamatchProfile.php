<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostApplicantLamatchProfile extends AbstractController
{
    public function __invoke(Request $request): void
    {
        $data = $request->attributes->get('content');
        dd($request->attributes);
    }
}
