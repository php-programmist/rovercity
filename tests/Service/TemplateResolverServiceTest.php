<?php

namespace App\Tests\Service;

use App\Service\TemplateResolverService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TemplateResolverServiceTest extends WebTestCase
{
    /** @var TemplateResolverService */
    private $template_resolver_service;
    
    public function setUp() {
        self::bootKernel();
        $this->template_resolver_service = self::$container->get(TemplateResolverService::class);
    }
    /** @test */
    public function returnsBrandTemplate()
    {
        $template_name = $this->template_resolver_service->getTemplateName('land-rover-discovery');
        $this->assertEquals('page/brand.html.twig',$template_name);
    }
    
    /** @test */
    public function returnsServiceTemplate()
    {
        $template_name = $this->template_resolver_service->getTemplateName('land-rover-discovery/remont_hodovoi');
        $this->assertEquals('page/service.html.twig',$template_name);
    }
}
