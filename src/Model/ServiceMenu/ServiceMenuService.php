<?php

namespace App\Model\ServiceMenu;

class ServiceMenuService
{
    public $name;
    public $path;
    
    public function __construct(ServiceDTO $service)
    {
        $this->name = trim($service->service_name);
        $this->path = trim($service->path,' /');
    }
}