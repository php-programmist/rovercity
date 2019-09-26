<?php

namespace App\Model\ServiceMenu;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServiceMenu
{
    /**
     * @var Connection
     */
    protected $connection;
    
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    
    public function getMenuSections($brand_id = 0)
    {
        $services = $this->getAllServicesByBrand($brand_id);
        return $this->groupBySections($services);
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
            ->where('brand_id = :brand_id')
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