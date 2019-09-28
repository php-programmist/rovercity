<?php

namespace App\Tests\Service;

use App\Service\WhatsAppService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WhatsAppServiceTest extends WebTestCase
{
    /** @var WhatsAppService */
    private $whats_app_service;
    
    public function setUp() {
        self::bootKernel();
        $this->whats_app_service = self::$container->get(WhatsAppService::class);
    }
    
    public function testGetWhatsAppBlockAllowed()
    {
        $table_name = 'price_fl_kuzvnoi';
        $html = $this->whats_app_service->getWhatsAppBlockHtml($table_name);
        $this->assertNotEquals('',$html);
    }
    public function testGetWhatsAppBlockNotAllowed()
    {
        $table_name = 'price_jaguar_pokraska';
        $html = $this->whats_app_service->getWhatsAppBlockHtml($table_name);
        $this->assertEquals('',$html);
    }
}