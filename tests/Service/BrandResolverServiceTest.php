<?php

namespace App\Tests\Service;

use App\Service\BrandResolverService;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BrandResolverServiceTest extends WebTestCase
{
    /** @var BrandResolverService */
    private $brand_resolver_service;
    
    public function setUp() {
        self::bootKernel();
        $this->brand_resolver_service = self::$container->get(BrandResolverService::class);
    }
    
    public function testReturnsValidBrand()
    {
        $brand = $this->brand_resolver_service->getBrand('land-rover-discovery');
        $this->assertEquals('Land Rover Discovery',$brand->getFullName());
    }
    
    public function testReturnsValidModel()
    {
        $brand = $this->brand_resolver_service->getBrand('remont_land_rover/discovery_1');
        $this->assertEquals('Land Rover Discovery 1',$brand->getFullName());
    }
    
    public function TestReturnsNoBrand()
    {
        $brand = $this->brand_resolver_service->getBrand('neispravnosti');
        $this->assertNull($brand);
    }
    
    
    
    public function testGetChildrenModelsList()
    {
        $brand = $this->brand_resolver_service->getBrand('land-rover-discovery');
        $models_list = $this->brand_resolver_service->getModelsList($brand);
        $this->assertInstanceOf(PersistentCollection::class,$models_list);
        $this->assertEquals(5,count($models_list),"Отличается число ожидаемых дочерних моделей");
    }
    
    public function testGetSiblingsModelsList()
    {
        $brand = $this->brand_resolver_service->getBrand('remont_land_rover/discovery_1');
        $models_list = $this->brand_resolver_service->getModelsList($brand);
        $this->assertInstanceOf(PersistentCollection::class,$models_list);
        $this->assertEquals(5,count($models_list),"Отличается число ожидаемых сестринских моделей");
    }
   
}
