<?php

namespace App\Service;

use App\Repository\BrandRepository;

class TemplateResolverService
{
    /**
     * @var BrandRepository
     */
    protected $brand_repository;
    
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
}