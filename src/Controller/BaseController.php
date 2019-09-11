<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseController extends AbstractController
{
    
    /**
     * @var BrandRepository
     */
    protected $brand_repository;
    
    public function __construct(BrandRepository $brand_repository)
    {
        $this->brand_repository = $brand_repository;
    }
    
    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $brands = $this->brand_repository->findAll();
        $parameters = array_merge($parameters,['brands'=>$brands]);
        return parent::render($view, $parameters ,  $response = null);
    }
    
}
