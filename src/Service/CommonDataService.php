<?php

namespace App\Service;

use App\Repository\BrandRepository;

use App\Repository\ContentRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommonDataService
{
    /**
     * @var BrandRepository
     */
    protected $brand_repository;
    /**
     * @var SpecialOffersService
     */
    protected $special_offers_service;
    
    /**
     * @var ContentRepository
     */
    protected $content_repository;
    /**
     * @var BrandResolverService
     */
    protected $brand_resolver_service;
    /**
     * @var WhatsappButtonService
     */
    protected $whatsapp_button_service;
    
    public function __construct(
        BrandRepository $brand_repository,
        SpecialOffersService $special_offers_service,
        ContentRepository $content_repository,
        BrandResolverService $brand_resolver_service,
        WhatsappButtonService $whatsapp_button_service
    ) {
        $this->brand_repository       = $brand_repository;
        $this->special_offers_service = $special_offers_service;
        $this->content_repository     = $content_repository;
        $this->brand_resolver_service = $brand_resolver_service;
        $this->whatsapp_button_service = $whatsapp_button_service;
    }
    
    /**
     * @param string $token
     *
     * @return array
     */
    public function getCommonData($token)
    {
        $path = $token ? ('/' . $token . '/') : '/';
        if ( ! $content = $this->content_repository->findOneBy(['path' => $path])) {
            throw new NotFoundHttpException();
        }
        $brands         = $this->brand_repository->findParents();
        $brand          = $this->brand_resolver_service->getBrand($token);
        $brand_name     = $this->brand_resolver_service->getBrandName($brand,$token);
        $special_offers = $this->special_offers_service->getSpecialOffers($brand_name,$token);
        $whatsapp_button = $this->whatsapp_button_service->getWhatsappButtonHtml();
        
        return compact('content', 'brands', 'special_offers', 'brand','whatsapp_button','brand_name');
    }
    
}
