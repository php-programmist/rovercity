<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    /** @test */
    public function indexReturns200Code()
    {
        $client = $this->createClient();
        $client->request('GET','/');
        $this->assertStatusCode(200,$client);
    }
    
    /** @test */
    public function brandReturns200Code()
    {
        $client = $this->createClient();
        $client->request('GET','/land-rover-discovery/');
        $this->assertStatusCode(200,$client);
    }
    
    /** @test */
    public function serviceReturns200Code()
    {
        $client = $this->createClient();
        $client->request('GET','/remont_land_rover/discovery_obsluzhivanie/');
        $this->assertStatusCode(200,$client);
    }
    
    /** @test */
    public function wrongPathReturns404Code()
    {
        $client = $this->createClient();
        $client->request('GET','/abrakadabra/discovery_obsluzhivanie/');
        $this->assertStatusCode(404,$client);
    }
}