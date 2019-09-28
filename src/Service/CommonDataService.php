<?php

namespace App\Service;

use App\DTO\CommonDataDTO;
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
     * @var WhatsAppService
     */
    protected $whats_app_service;
    
    public function __construct(
        BrandRepository $brand_repository,
        SpecialOffersService $special_offers_service,
        ContentRepository $content_repository,
        BrandResolverService $brand_resolver_service,
        WhatsAppService $whats_app_service
    ) {
        $this->brand_repository       = $brand_repository;
        $this->special_offers_service = $special_offers_service;
        $this->content_repository     = $content_repository;
        $this->brand_resolver_service = $brand_resolver_service;
        $this->whats_app_service      = $whats_app_service;
    }
    
    /**
     * @param string $token
     *
     * @return CommonDataDTO
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getCommonData($token)
    {
        $common_data = new CommonDataDTO();
        $path        = $token ? ('/' . $token . '/') : '/';
        if ( ! $content = $this->content_repository->findOneBy(['path' => $path])) {
            throw new NotFoundHttpException();
        }
        $common_data->content         = $content;
        $common_data->brands          = $this->brand_repository->findParents();
        $common_data->brand           = $this->brand_resolver_service->getBrand($token);
        $common_data->brand_name      = $this->brand_resolver_service->getBrandName($common_data->brand, $token);
        $common_data->special_offers  = $this->special_offers_service->getSpecialOffers($common_data->brand_name,
            $token);
        $common_data->whatsapp_button = $this->whats_app_service->getWhatsAppButtonHtml();
        
        return $common_data;
    }
    
}
