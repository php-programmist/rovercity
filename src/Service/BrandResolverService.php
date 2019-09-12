<?php

namespace App\Service;

use App\Entity\Brand;
use App\Repository\BrandRepository;

class BrandResolverService
{
    /**
     * @var BrandRepository
     */
    protected $brand_repository;
    
    public function __construct(BrandRepository $brand_repository)
    {
        $this->brand_repository = $brand_repository;
    }
    
    /**
     * @param $token
     *
     * @return \App\Entity\Brand|null
     */
    public function getBrand($token):?Brand
    {
        $brands = $this->brand_repository->findAll();
        foreach ($brands as $brand) {
            if (strpos($token, $brand->getAlias())!==false) {
                return $brand;
            }
        }
        return null;
    }
}