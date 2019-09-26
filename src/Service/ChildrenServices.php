<?php

namespace App\Service;

use App\Entity\Content;
use App\Repository\BrandMenuRepository;
use App\Repository\ContentRepository;
use Twig\Environment;

class ChildrenServices
{
    /**
     * @var Environment
     */
    protected $twig;
    /**
     * @var ContentRepository
     */
    protected $content_repository;
    /**
     * @var BrandMenuRepository
     */
    protected $brand_menu_repository;
    
    public function __construct(
        Environment $twig,
        ContentRepository $content_repository,
        BrandMenuRepository $brand_menu_repository
    ) {
        $this->twig                  = $twig;
        $this->content_repository    = $content_repository;
        $this->brand_menu_repository = $brand_menu_repository;
    }
    
    public function getChildrenServices(Content $content)
    {
        if ($this->brand_menu_repository->isBrandMenu($content->getPath())) {
            return '';
        }
        
        $children = $this->content_repository->findBy(['parent' => $content->getId()]);
        if ( ! count($children)) {
            return '';
        }
        $children = array_map(function (Content $content) {
            return $content->setPath(trim($content->getPath(), ' /'));
        }, $children);
        
        return $this->twig->render('modules/children_services.html.twig', compact( 'children'));
    }
    
}