<?php

namespace App\Service;

use App\Repository\BrandRepository;

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
     * @var BrandResolverService
     */
    protected $brand_resolver;
    
    public function __construct(BrandRepository $brand_repository, SpecialOffersService $special_offers_service,BrandResolverService $brand_resolver)
    {
        $this->brand_repository = $brand_repository;
        $this->special_offers_service = $special_offers_service;
        $this->brand_resolver = $brand_resolver;
    }
    
    public function getCommonData($token)
    {
        $brands = $this->brand_repository->findAll();
        $brand = $this->brand_resolver->getBrand($token);
        $special_offers = $this->special_offers_service->getSpecialOffers($token);
        return compact('brands','brand','special_offers');
    }
    
    public function addCommonData($params, $token)
    {
        return array_merge($params, $this->getCommonData($token));
    }
    
}
