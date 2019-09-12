<?php

namespace App\Tests\Service;

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
    }
    
    /** @test */
    public function addCommonData()
    {
        $params = ['some_param'=>'some_value'];
        $token = 'land-rover-discovery';
        $common_data = $this->common_data_service->getCommonData($token);
        $result = array_merge($params,$common_data);
        $this->assertEquals($result,$this->common_data_service->addCommonData($params,$token));
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
