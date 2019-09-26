<?php

namespace App\Service;

use App\Entity\Brand;
use App\Model\ServiceMenu\ServiceMenu;
use App\Repository\BrandRepository;
use App\Model\PriceList\PriceList;

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
    /**
     * @var PriceList
     */
    protected $price_list;
    /**
     * @var ServiceMenu
     */
    protected $service_menu;
    
    public function __construct(
        BrandRepository $brand_repository,
        SpecialOffersService $special_offers_service,
        BrandResolverService $brand_resolver,
        PriceList $price_list,
        ServiceMenu $service_menu
    ) {
        $this->brand_repository       = $brand_repository;
        $this->special_offers_service = $special_offers_service;
        $this->brand_resolver         = $brand_resolver;
        $this->price_list             = $price_list;
        $this->service_menu           = $service_menu;
    }
    
    public function getCommonData($token)
    {
        $brands                = $this->brand_repository->findParents();
        $brand                 = $this->brand_resolver->getBrand($token);
        $percent               = $brand ? $brand->getPercent() : 0;
        $price_list_sections   = $this->price_list->getPriceData($token, $percent);
        $models_list           = $this->brand_resolver->getModelsList($brand);
        $special_offers        = $this->special_offers_service->getSpecialOffers($token);
        $service_menu_sections = $this->service_menu->getMenuSections($brand ? $brand->getId() : 0);
        
        return compact('brands', 'brand', 'special_offers', 'price_list_sections', 'models_list', 'service_menu_sections');
    }
    
    public function addCommonData($params, $token)
    {
        return array_merge($params, $this->getCommonData($token));
    }
    
}
