<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SlickLazyLoadExtension extends AbstractExtension
{
    
    public function getFunctions(): array
    {
        return [
            new TwigFunction('slick_lazy_load', [$this, 'lazyLoad'],['is_safe' => ['html']]),
        ];
    }
    
    /**
     * @param string $src
     * @param bool   $lazy_off
     *
     * @return string
     */
    public function lazyLoad(string $src,$lazy_off = false):string
    {
        if ($lazy_off) {
            return 'src="'.$src.'"';
        }
        return 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-lazy="'.$src.'"';
        
    }
}
