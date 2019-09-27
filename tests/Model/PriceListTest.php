<?php

namespace App\Tests\Model;

use App\Model\PriceList\PriceList;
use App\Model\PriceList\PriceListSection;
use App\Repository\BrandMenuRepository;
use App\Repository\ContentRepository;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Twig\Environment;

class PriceListTest extends KernelTestCase
{
    /** @var Connection */
    private $connection;
    private $content_repository;
    private $twig;
    private $brand_menu_repository;
    
    public function setUp() {
        self::bootKernel();
        $this->connection = self::$container->get(Connection::class);
        $this->content_repository = self::$container->get(ContentRepository::class);
        $this->twig = self::$container->get(Environment::class);
        $this->brand_menu_repository = self::$container->get(BrandMenuRepository::class);
    }
    
    public function testGetAllServices()
    {
        $price_list_model = new PriceList($this->connection,$this->content_repository, $this->twig,$this->brand_menu_repository);
        $services = $price_list_model->getAllSections();
        $this->assertIsArray($services);
        $this->assertInstanceOf(PriceListSection::class,reset($services));
        $this->assertCount(12,$services);
    }
    
    public function testGetOneSection()
    {
        $percent=5;
        $price_list_model = new PriceList($this->connection,$this->content_repository, $this->twig,$this->brand_menu_repository);
        $services = $price_list_model->getSingleTable('price_frelander_xodovaya',1);
        $this->assertIsArray($services);
        $price_list_sections = $price_list_model->groupOneSection($services, $percent);
        $this->assertInstanceOf(PriceListSection::class,reset($price_list_sections));
        $this->assertCount(1,$price_list_sections);
    }
    
    public function testGetOneTableSubSections()
    {
        $percent=5;
        $price_list_model = new PriceList($this->connection,$this->content_repository, $this->twig,$this->brand_menu_repository);
        $services = $price_list_model->getSingleTable('price_frelander_xodovaya',0);
        $this->assertIsArray($services);
        $price_list_sections = $price_list_model->groupSubSections($services, $percent);
        $this->assertInstanceOf(PriceListSection::class,reset($price_list_sections));
        $this->assertCount(7,$price_list_sections);
    }
}