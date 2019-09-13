<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful(),"Wrong url is $url");
    }
    
    
    public function provideUrls()
    {
        return [
            ['/'],
            ['/land-rover-discovery/'],
            ['/remont_land_rover/discovery_obsluzhivanie/'],
            ['/neispravnosti/'],
        ];
    }
   
    public function testWrongPathReturns404Code()
    {
        $client = $this->createClient();
        $client->request('GET','/abrakadabra/discovery_obsluzhivanie/');
        $this->assertStatusCode(404,$client);
    }
}