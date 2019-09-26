<?php

namespace App\Tests\Service;

use App\Entity\Brand;
use App\Entity\Content;
use App\Service\CommonDataService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommonDataServiceTest extends WebTestCase
{
    /** @var CommonDataService */
    private $common_data_service;
    
    public function setUp() {
        self::bootKernel();
        $this->common_data_service = self::$container->get(CommonDataService::class);
    }
    /** @test */
    public function getCommonData()
    {
        $common_data = $this->common_data_service->getCommonData('land-rover-discovery');
        $this->assertIsArray($common_data);
        $this->assertNotEmpty($common_data);
        $this->assertNotEmpty($common_data['brands']);
        $this->assertIsArray($common_data['brands']);
        $this->assertNotEmpty($common_data['special_offers']);
        $this->assertIsArray($common_data['special_offers']);
        $this->assertNotEmpty($common_data['content']);
        $this->assertInstanceOf(Content::class,$common_data['content']);
        $this->assertNotEmpty($common_data['brand']);
        $this->assertInstanceOf(Brand::class,$common_data['brand']);
    }
    
    /** @test */
    public function differentTokens()
    {
        $token1 = 'land-rover-discovery';
        $token2 = 'neispravnosti';
        $common_data1 = $this->common_data_service->getCommonData($token1);
        $common_data2 = $this->common_data_service->getCommonData($token2);
        $this->assertNotEquals($common_data1,$common_data2);
    }
}
