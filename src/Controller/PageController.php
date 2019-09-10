<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
    
    /**
     * @Route("/neispravnosti/", name="neispravnosti")
     */
    public function neispravnosti()
    {
        dd('neispravnosti');
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
    
    /**
     * @Route("/{token}/", name="dynamic_pages", requirements={"token"=".+"})
     */
    public function dynamic_pages($token)
    {
        
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
