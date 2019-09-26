<?php

namespace App\Tests\Model;

use App\Model\ServiceMenu\ServiceMenu;
use App\Model\ServiceMenu\ServiceMenuSection;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ServiceMenuTest extends KernelTestCase
{
    /** @var Connection */
    private $connection;
    
    public function setUp() {
        self::bootKernel();
        $this->connection = self::$container->get(Connection::class);
    }
    
    public function testGetMenuSectionsWithBrand()
    {
        $service_menu = new ServiceMenu($this->connection);
        $sections = $service_menu->getMenuSections(1);
        $this->assertIsArray($sections);
        $this->assertInstanceOf(ServiceMenuSection::class,$sections[1]);
        $this->assertCount(12,$sections);
    }
    public function testGetMenuSectionsWithOutBrand()
    {
        $service_menu = new ServiceMenu($this->connection);
        $sections = $service_menu->getMenuSections();
        $this->assertIsArray($sections);
        $this->assertInstanceOf(ServiceMenuSection::class,$sections[1]);
        $this->assertCount(12,$sections);
    }
    
}