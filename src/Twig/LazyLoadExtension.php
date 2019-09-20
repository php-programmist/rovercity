<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LazyLoadExtension extends AbstractExtension
{
    
    public function getFunctions(): array
    {
        return [
            new TwigFunction('lazy_load', [$this, 'lazyLoad'],['is_safe' => ['html']]),
        ];
    }
    
    /**
     * @param string $src
     * @param array  $classes
     *
     * @param bool   $lazy_off
     *
     * @return string
     */
    public function lazyLoad(string $src,array $classes=[],$lazy_off = false):string
    {
        $classes[]='b-lazy';
        if ($lazy_off) {
            return 'src="'.$src.'" class="'.implode(' ',$classes).'"';
        }
        return 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="'.$src.'"
        class="'.implode(' ',$classes).'"';
    }
}
