<?php

namespace App\Model\PriceList;

class PriceListSection
{
    public $table;
    public $section_name;
    public $percent;
    public $services=[];
    
    public function __construct($table,$section_name,$service,$percent = 0)
    {
        $this->table = $table;
        $this->section_name = $section_name;
        $this->percent = $percent;
        $this->addService($service);
    }
    
    public function addService($service)
    {
        $service->rasdel = trim($service->rasdel);
        if ( ! trim($service->rasdel)) {
            return;
        }
        $this->services[] = new PriceListService($service, $this->percent);
    }
}