<?php

namespace App\Service;

use App\Repository\BrandRepository;

class TemplateResolverService
{
    /**
     * @var BrandRepository
     */
    protected $brand_repository;
    
    public const MAIN_TYPE = 0;
    public const BRAND_TYPE = 1;
    public const SERVICE_TYPE = 2;
    
    public function __construct(BrandRepository $brand_repository)
    {
        $this->brand_repository = $brand_repository;
    }
    
    public function getTemplateName($token)
    {
        if ($this->brand_repository->findOneBy(['alias'=>$token])) {
            return 'page/brand.html.twig';
        }
    
        return 'page/service.html.twig';
    }
    
    public function getTemplateType($token)
    {
        if ($this->brand_repository->findOneBy(['alias'=>$token])) {
            return self::BRAND_TYPE;
        }
    
        return self::SERVICE_TYPE;
    }
}