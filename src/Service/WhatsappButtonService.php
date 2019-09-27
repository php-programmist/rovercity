<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class WhatsappButtonService
{
    /**
     * @var ParameterBagInterface
     */
    protected $params;
    /**
     * @var Environment
     */
    protected $twig;
    
    public function __construct(ParameterBagInterface $params, Environment $twig)
    {
    
        $this->params = $params;
        $this->twig = $twig;
    }
    
    public function getWhatsappButtonHtml()
    {
        $params = $this->params->get('whatsapp');
        if (empty($params['text']) || empty($params['phone'])) {
            return '';
        }
        $whatsApp_text  = urlencode($params['text']);
        $whatsapp_link  = "https://wa.me/{$params['phone']}?text={$whatsApp_text}";
        return $this->twig->render('modules/whatsapp_button.html.twig',compact('whatsapp_link'));
    }
}