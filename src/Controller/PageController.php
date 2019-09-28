<?php

namespace App\Controller;

use App\DTO\CommonDataDTO;
use App\Model\PriceList\PriceList;
use App\Model\ServiceMenu\ServiceMenu;
use App\Service\BrandResolverService;
use App\Service\ChildrenServices;
use App\Service\CommonDataService;
use App\Service\TemplateResolverService;
use App\Service\WhatsAppService;
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
    /**
     * @var WhatsAppService
     */
    protected $whats_app_service;
    
    public function __construct(
        CommonDataService $common_data_service,
        ServiceMenu $service_menu,
        PriceList $price_list,
        BrandResolverService $brand_resolver_service,
        ChildrenServices $children_services,
        WhatsAppService $whats_app_service
    ) {
        $this->common_data_service    = $common_data_service;
        $this->service_menu           = $service_menu;
        $this->price_list             = $price_list;
        $this->brand_resolver_service = $brand_resolver_service;
        $this->children_services      = $children_services;
        $this->whats_app_service = $whats_app_service;
    }
    
    public function index()
    {
        $service_menu = $this->service_menu->getServiceMenu();
        $common_data  = $this->common_data_service->getCommonData('');
        $price_list   = $this->price_list->getAllSectionsHtml('Прайс лист на ремонт и обслуживание Land Rover');
        $params       = array_merge((array)$common_data, compact('service_menu', 'price_list'));
        
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
    /**
     * @param CommonDataDTO $common_data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function brandTemplate($common_data)
    {
        $service_menu = $this->service_menu->getServiceMenu($common_data->brand);
        $price_list   = $this->price_list->getAllSectionsHtml($common_data->content->getH1().' Цена:',$common_data->brand);
        $models_list  = $this->brand_resolver_service->getModelsList($common_data->brand);
        $params       = array_merge((array)$common_data, compact('service_menu', 'price_list', 'models_list'));
        
        return $this->render('page/brand.html.twig', $params);
    }
    
    /**
     * @param CommonDataDTO $common_data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function serviceTemplate($common_data)
    {
        $price_list        = $this->price_list->getSingleSectionHtml($common_data->content,
            $common_data->brand);
        $children_services = $this->children_services->getChildrenServices($common_data->content);
        $whats_app_block = $this->whats_app_service->getWhatsAppBlockHtml($common_data->content->getPriceTable());
        $params            = array_merge((array)$common_data, compact('price_list', 'children_services','whats_app_block'));
        
        return $this->render('page/service.html.twig', $params);
    }
}
