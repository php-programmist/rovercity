<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class WhatsAppService
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
    
    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getWhatsAppButtonHtml()
    {
        if (!$whatsapp_link = $this->getLink()) {
            return '';
        }
        return $this->twig->render('modules/whatsapp_button.html.twig',compact('whatsapp_link'));
    }
    
    /**
     * @param $table_name
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getWhatsAppBlockHtml($table_name)
    {
        $allowed_tables = [
            'price_fl_kuzvnoi',
            'price_jaguar_kuzovnoi_remont',
            'price_rr_kuzovnoi_remont',
            'price_lr',
        ];
        if ( ! in_array($table_name, $allowed_tables)) {
            return '';
        }
        
        if (!$whatsapp_link = $this->getLink()) {
            return '';
        }
        return $this->twig->render('modules/whatsapp_block.html.twig',compact('whatsapp_link'));
    }
    
    /**
     * @return null|string
     */
    protected function getLink()
    {
        $params = $this->params->get('whatsapp');
        if (empty($params['text']) || empty($params['phone'])) {
            return null;
        }
        $whatsApp_text  = urlencode($params['text']);
        return "https://wa.me/{$params['phone']}?text={$whatsApp_text}";
    }
}