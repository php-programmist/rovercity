<?php

namespace App\Tests\Model;

use App\Model\PriceList\PriceList;
use App\Model\PriceList\PriceListSection;
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
    
    public function setUp() {
        self::bootKernel();
        $this->connection = self::$container->get(Connection::class);
        $this->content_repository = self::$container->get(ContentRepository::class);
        $this->twig = self::$container->get(Environment::class);
    }
    
    public function testGetAllServices()
    {
        $price_list_model = new PriceList($this->connection,$this->content_repository, $this->twig);
        $services = $price_list_model->getAllSections();
        $this->assertIsArray($services);
        $this->assertInstanceOf(PriceListSection::class,reset($services));
        $this->assertCount(12,$services);
    }
    
    public function testGetOneSection()
    {
        $price_list_model = new PriceList($this->connection,$this->content_repository, $this->twig);
        $services = $price_list_model->getSingleSection('price_frelander_xodovaya',1,5);
        $this->assertIsArray($services);
        $this->assertInstanceOf(PriceListSection::class,reset($services));
        $this->assertCount(1,$services);
    }
}