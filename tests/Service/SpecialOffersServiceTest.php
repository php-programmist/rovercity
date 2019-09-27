<?php

namespace App\Tests\Service;

use App\Service\SpecialOffersService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpecialOffersServiceTest extends WebTestCase
{
    /** @var SpecialOffersService */
    private $special_offers_service;
    
    public function setUp() {
        self::bootKernel();
        $this->special_offers_service = self::$container->get(SpecialOffersService::class);
    }
    /** @test */
    public function returnsAllOffers()
    {
        $offers = $this->special_offers_service->getSpecialOffers('land-rover-discovery');
        $this->assertIsArray($offers);
        $this->assertNotEmpty($offers);
    }
    
    /** @test */
    public function returnsNotHiddenOffers()
    {
        $offers = $this->special_offers_service->getSpecialOffers('neispravnosti');
        $this->assertIsArray($offers,'neispravnosti');
        $this->assertNotEmpty($offers,'neispravnosti');
    
        $offers = $this->special_offers_service->getSpecialOffers('articles');
        $this->assertIsArray($offers,'articles');
        $this->assertNotEmpty($offers,'articles');
    }
    
    /** @test */
    public function diagnosticOfferWithBrand()
    {
        $offers = $this->special_offers_service->getSpecialOffers('land-rover-discovery');
        foreach ($offers as $offer){
            if ($offer->getName() === 'Бесплатная диагностика') {
                $this->assertEquals('Комплексная диагностика Land Rover Discovery',$offer->getDescription());
            }
        }
    }
    
    /** @test */
    public function diagnosticOfferWithOutBrand()
    {
        $offers = $this->special_offers_service->getSpecialOffers('neispravnosti');
        foreach ($offers as $offer){
            if ($offer->getName() === 'Бесплатная диагностика') {
                $this->assertEquals('Комплексная диагностика Land Rover',$offer->getDescription());
            }
        }
    }
}
