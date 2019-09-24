<?php

namespace App\Model\PriceList;

class PriceListService
{
    public $name;
    public $price;
    
    /**
     * PriceListService constructor.
     *
     * @param \StdClass $service_std_obj
     * @param int       $percent
     */
    public function __construct($service_std_obj, $percent = 0)
    {
        $this->name = $this->mb_ucfirst($service_std_obj->rasdel);
        $this->setPrice((float)$service_std_obj->normo_chas, (float)$service_std_obj->cena, $percent);
    }
    
    private function setPrice($normo_chas, $cena, $percent)
    {
        $this->price = $normo_chas * $cena * (100 + $percent) / 100;
        $this->price = (int)ceil($this->price / 10) * 10;
    }
    
    private function mb_ucfirst($text)
    {
        return mb_strtoupper(mb_substr($text, 0, 1, 'utf-8')) . mb_substr($text, 1, null, 'utf-8');
    }
    
}