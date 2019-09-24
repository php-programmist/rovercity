<?php

namespace App\Model\PriceList;

class PriceListSection
{
    public $table;
    public $section_name;
    public $services=[];
    
    public function __construct($table,$section_name,$services,$percent = 0)
    {
        $this->table = $table;
        $this->section_name = $section_name;
        foreach ($services as $service) {
            $service->rasdel = trim($service->rasdel);
            if ( ! trim($service->rasdel)) {
                continue;
            }
            $this->services[] = new PriceListService($service,$percent);
        }
    }
}