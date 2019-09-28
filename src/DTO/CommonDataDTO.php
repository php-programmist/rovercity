<?php

namespace App\DTO;

use App\Entity\Brand;
use App\Entity\Content;
use App\Entity\SpecialOffer;

class CommonDataDTO
{
    /** @var Content*/
    public $content;
    
    /** @var Brand[]*/
    public $brands;
    
    /** @var ?Brand*/
    public $brand;
    
    /** @var string*/
    public $brand_name;
    
    /** @var string*/
    public $root_brand_name;
    
    /** @var SpecialOffer[]*/
    public $special_offers;
    
    /** @var string*/
    public $whatsapp_button;
    
    /** @var string*/
    public $our_works;
}