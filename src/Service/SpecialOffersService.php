<?php

namespace App\Service;

use App\Repository\SpecialOfferRepository;

class SpecialOffersService
{
    /**
     * @var SpecialOfferRepository
     */
    protected $special_offer_repository;
    /**
     * @var BrandResolverService
     */
    protected $brand_resolver;
    
    public function __construct(SpecialOfferRepository $special_offer_repository, BrandResolverService $brand_resolver)
    {
        
        $this->special_offer_repository = $special_offer_repository;
        $this->brand_resolver = $brand_resolver;
    }
    
    public function getSpecialOffers($token)
    {
        $brand_name = $this->brand_resolver->getBrandName($token);
        $criteria = ['published'=>1];
        if (strpos($token, 'neispravnosti') !== false || strpos($token, 'articles') !== false) {
            $criteria['hidden']=0;
        }
        if (!$offers = $this->special_offer_repository->findBy($criteria)) {
            return [];
        }
        foreach ($offers as $index => $offer) {
            if ($brand_name) {
                if ($offer->getName() === 'Бесплатная диагностика') {
                    $offer->setDescription('Комплексная диагностика ' . $brand_name);
                }
                else{
                    $offer->setDescription(trim(str_replace('#BRAND',$brand_name,$offer->getDescription())));
                }
            }
            else{
                $offer->setDescription(trim(str_replace('#BRAND','',$offer->getDescription())));
            }
            $offers[$index] = $offer;
        }
        return $offers;
    }
}