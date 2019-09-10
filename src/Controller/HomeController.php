<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends AbstractController
{
    
    public function index(ContentRepository $content_repository)
    {
        if (!$content_entity = $content_repository->findOneBy(['path' => '/'])) {
            throw new NotFoundHttpException();
        }
        return $this->render('home/index.html.twig', [
            'content' => $content_entity,
        ]);
    }
}
