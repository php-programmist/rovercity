<?php

namespace App\Controller;

use App\Model\PriceList\PriceList;
use App\Model\ServiceMenu\ServiceMenu;
use App\Service\BrandResolverService;
use App\Service\ChildrenServices;
use App\Service\CommonDataService;
use App\Service\TemplateResolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends AbstractController
{
    /**
     * @var CommonDataService
     */
    protected $common_data_service;
    /**
     * @var ServiceMenu
     */
    protected $service_menu;
    /**
     * @var PriceList
     */
    protected $price_list;
    /**
     * @var BrandResolverService
     */
    protected $brand_resolver_service;
    /**
     * @var ChildrenServices
     */
    protected $children_services;
    
    public function __construct(
        CommonDataService $common_data_service,
        ServiceMenu $service_menu,
        PriceList $price_list,
        BrandResolverService $brand_resolver_service,
        ChildrenServices $children_services
    ) {
        $this->common_data_service    = $common_data_service;
        $this->service_menu           = $service_menu;
        $this->price_list             = $price_list;
        $this->brand_resolver_service = $brand_resolver_service;
        $this->children_services      = $children_services;
    }
    
    public function index()
    {
        $service_menu = $this->service_menu->getServiceMenu();
        $common_data  = $this->common_data_service->getCommonData('');
        $price_list   = $this->price_list->getAllSectionsHtml();
        $params       = array_merge($common_data, compact('service_menu', 'price_list'));
        
        return $this->render('page/index.html.twig', $params);
    }
    
    public function dynamic_pages(
        $token,
        TemplateResolverService $template_resolver
    ) {
        $common_data = $this->common_data_service->getCommonData($token);
        
        $template_type = $template_resolver->getTemplateType($token);
        switch ($template_type) {
            case TemplateResolverService::BRAND_TYPE:
                return $this->brandTemplate($common_data);
                break;
            case TemplateResolverService::SERVICE_TYPE:
                return $this->serviceTemplate($common_data);
                break;
            default:
                throw new NotFoundHttpException("Не определен тип страницы");
        }
        
    }
    
    protected function brandTemplate($common_data)
    {
        $service_menu = $this->service_menu->getServiceMenu($common_data['brand']);
        $price_list   = $this->price_list->getAllSectionsHtml($common_data['brand']);
        $models_list  = $this->brand_resolver_service->getModelsList($common_data['brand']);
        $params       = array_merge($common_data, compact('service_menu', 'price_list', 'models_list'));
        
        return $this->render('page/brand.html.twig', $params);
    }
    
    protected function serviceTemplate($common_data)
    {
        $price_list        = $this->price_list->getSingleSectionHtml($common_data['content'],
            $common_data['brand']);
        $children_services = $this->children_services->getChildrenServices($common_data['content']);
        $params            = array_merge($common_data, compact('price_list', 'children_services'));
        
        return $this->render('page/service.html.twig', $params);
    }
}
