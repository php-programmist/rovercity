<?php

namespace App\Tests\Model;

use App\Model\PriceList\PriceList;
use App\Model\PriceList\PriceListSection;
use App\Repository\ContentRepository;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceListTest extends KernelTestCase
{
    /** @var Connection */
    private $connection;
    private $content_repository;
    
    public function setUp() {
        self::bootKernel();
        $this->connection = self::$container->get(Connection::class);
        $this->content_repository = self::$container->get(ContentRepository::class);
    }
    
    public function testGetAllServices()
    {
        $price_list_model = new PriceList($this->connection,$this->content_repository);
        $services = $price_list_model->getPriceData('land-rover-discovery');
        $this->assertIsArray($services);
        $this->assertInstanceOf(PriceListSection::class,reset($services));
        $this->assertCount(12,$services);
    }
    
    public function testGetOneSection()
    {
        $price_list_model = new PriceList($this->connection,$this->content_repository);
        $services = $price_list_model->getPriceData('remont_land_rover/discovery_obsluzhivanie');
        $this->assertIsArray($services);
        $this->assertInstanceOf(PriceListSection::class,reset($services));
        $this->assertCount(1,$services);
    }
}