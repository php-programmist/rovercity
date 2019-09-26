<?php

namespace App\Model\ServiceMenu;

class ServiceMenuSection
{
    public $name;
    public $image;
    public $services = [];
    
    public function __construct(ServiceDTO $service)
    {
        $this->name = $service->section_name;
        $this->image = $service->image;
        $this->addService($service);
    }
    
    public function addService($service)
    {
        $this->services[] = new ServiceMenuService($service);
    }
}