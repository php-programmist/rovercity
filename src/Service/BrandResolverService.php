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
    public function getBrand($token): ?Brand
    {
        $brands = $this->brand_repository->findAllSortedByAliasLength();
        foreach ($brands as $brand) {
            if (strpos($token, $brand->getAlias()) !== false) {
                return $brand;
            }
        }
        
        return null;
    }
    
    /**
     * @param Brand $brand
     *
     * @return null|Brand[]
     */
    public function getModelsList($brand)
    {
        if ( ! $brand) {
            return null;
        }
        
        if (stripos($brand->getFullName(), 'jaguar') === false && $parent = $brand->getParent()) {
            $models = $parent->getChildren();
        } else {
            $models = $brand->getChildren();
        }
        
        return $models;
    }
    
    public function getBrandName(?Brand $brand, string $token)
    {
        if ($brand) {
            return $brand->getFullName();
        }
        if (stripos($token, 'jaguar') !== false) {
            return 'Jaguar';
        }
        
        return 'Land Rover';
    }
    
    public function getRootBrandName($brand_name)
    {
        if (stripos($brand_name, 'jaguar') !== false) {
            return 'Jaguar';
        }
        return 'Land Rover';
    }
}