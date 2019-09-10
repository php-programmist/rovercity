<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PageController extends AbstractController
{
    public function dynamic_pages($token,ContentRepository $content_repository)
    {
        if (!$content_entity = $content_repository->findOneBy(['path' => '/' . $token . '/'])) {
            throw new NotFoundHttpException();
        }
        
        return $this->render('page/index.html.twig', [
            'content' => $content_entity,
        ]);
    }
}
