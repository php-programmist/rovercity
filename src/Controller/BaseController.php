<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\ContentRepository;
use App\Service\SpecialOffersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseController extends AbstractController
{
    /**
     * @var BrandRepository
     */
    protected $brand_repository;
    /**
     * @var SpecialOffersService
     */
    protected $special_offers_service;
    
    public function __construct(BrandRepository $brand_repository, SpecialOffersService $special_offers_service)
    {
        $this->brand_repository = $brand_repository;
        $this->special_offers_service = $special_offers_service;
    }
    
    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $brands = $this->brand_repository->findAll();
        $special_offers = $this->special_offers_service->getSpecialOffers($_SERVER['REQUEST_URI']);
        $parameters = array_merge($parameters,compact('brands','special_offers'));
        return parent::render($view, $parameters ,  $response = null);
    }
    
}
