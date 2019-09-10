<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
