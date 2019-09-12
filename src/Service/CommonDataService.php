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
    
    public function __construct(BrandRepository $brand_repository, SpecialOffersService $special_offers_service)
    {
        $this->brand_repository = $brand_repository;
        $this->special_offers_service = $special_offers_service;
    }
    
    public function getCommonData($token)
    {
        $brands = $this->brand_repository->findAll();
        $special_offers = $this->special_offers_service->getSpecialOffers($token);
        return compact('brands','special_offers');
    }
    
    public function addCommonData($params, $token)
    {
        return array_merge($params, $this->getCommonData($token));
    }
    
}
