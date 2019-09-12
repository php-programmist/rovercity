<?php

namespace App\Tests\Service;

use App\Service\BrandResolverService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BrandResolverServiceTest extends WebTestCase
{
    /** @var BrandResolverService */
    private $brand_resolver_service;
    
    public function setUp() {
        self::bootKernel();
        $this->brand_resolver_service = self::$container->get(BrandResolverService::class);
    }
    /** @test */
    public function returnsValidBrand()
    {
        $brand = $this->brand_resolver_service->getBrand('land-rover-discovery');
        $this->assertEquals('Land Rover Discovery',$brand->getFullName());
    }
    /** @test */
    public function returnsNoBrand()
    {
        $brand = $this->brand_resolver_service->getBrand('neispravnosti');
        $this->assertNull($brand);
    }
   
}
