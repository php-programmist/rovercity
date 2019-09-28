<?php

namespace App\Service;

use Twig\Environment;

class OurWorksService
{
    /**
     * @var Environment
     */
    protected $twig;
    
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function getOurWorksHtml(array $images = [])
    {
        if (empty($images)) {
            $images = $this->getCommonImages();
        }
        return $this->twig->render('modules/our_works.html.twig',compact('images'));
    }
    
    private function getCommonImages()
    {
        $images=[];
        for ($i=1;$i<=10;$i++){
            $images[] = 'common/'.$i.'.jpg';
        }
        return $images;
    }
}