<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RecipientResolverService
{
    private $email_addresses;
    
    public function __construct(ParameterBagInterface $params)
    {
        $this->email_addresses = $params->get('email_addresses');
    }
    
    public function getRecipients($phone)
    {
        $phoneCheck = preg_replace('~\D+~','',$phone);
        
        $recipients = $this->email_addresses['dev'];
        if(!stristr($phoneCheck,'71111111111')){
            $recipients = array_merge($recipients,$this->email_addresses['work']);
        }
        return $recipients;
    }
}