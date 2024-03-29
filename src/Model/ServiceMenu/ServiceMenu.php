<?php

namespace App\Model\ServiceMenu;

use App\Entity\Brand;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class ServiceMenu
{
    /**
     * @var Connection
     */
    protected $connection;
    /**
     * @var Environment
     */
    protected $twig;
    
    public function __construct(Connection $connection,Environment $twig)
    {
        $this->connection = $connection;
        $this->twig = $twig;
    }
    
    public function getMenuSections($brand_id = 0)
    {
        $services = $this->getAllServicesByBrand($brand_id);
        return $this->groupBySections($services);
    }
    
    public function getServiceMenu(?Brand $brand=null)
    {
        $service_menu_sections = $this->getMenuSections($brand?$brand->getId():0);
        return $this->twig->render('modules/services.html.twig',compact('brand','service_menu_sections'));
    }
    
    
    /**
     * @param int $brand_id
     *
     * @return mixed[]
     */
    protected function getAllServicesByBrand($brand_id = 0)
    {
        $services = $this->connection
            ->createQueryBuilder()
            ->select('s.name as section_name, s.image, m.section_id, m.content_id, c.path,c.name as service_name')
            ->from('services_map','m')
            ->leftJoin('m','services_sections','s','s.id = m.section_id')
            ->leftJoin('m','content','c','c.id = m.content_id')
            ->andWhere('brand_id = :brand_id')
            ->setParameter(':brand_id',$brand_id)
            ->execute()
            ->fetchAll(\PDO::FETCH_CLASS,ServiceDTO::class);
        if ( ! $services) {
            throw new NotFoundHttpException("Не найдены услуги для меню");
        }
        return $services;
    }
    
    /**
     * @param array ServiceDTO[] $services
     *
     * @return array ServiceMenuSection[]
     */
    protected function groupBySections($services)
    {
        $sections = [];
        foreach ($services as $service) {
            if (!isset($sections[$service->section_id])){
                $sections[$service->section_id] = new ServiceMenuSection($service);
            }
            else{
                $sections[$service->section_id]->addService($service);
            }
        }
        return $sections;
    }
}