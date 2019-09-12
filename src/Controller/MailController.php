<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class MailController extends AbstractController
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;
    private $request;
    private $email_addresses;
    
    public function __construct(\Swift_Mailer $mailer, RequestStack $request_stack,ParameterBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->request = $request_stack->getCurrentRequest();
        $this->email_addresses = $params->get('email_addresses');
        
    }
    
    public function callback()
    {
        $name = $this->request->get('name');
        $phone = $this->request->get('phone');
        $subject = $this->request->get('subject');
        $referer = @$_SERVER['HTTP_REFERER'];
        $template = 'emails/callback.html.twig';
        
        $mes = 'ok';
        if (! $this->sendMail($template,compact('name','phone','subject','referer'))) {
            $mes = 'error';
        }
        return new Response($mes);
    }
    
    private function sendMail($template,$params)
    {
        $recipients = $this->getRecipients($params['phone']);
        
        $message = (new \Swift_Message($params['subject']))
            ->setFrom($this->email_addresses['from'])
            ->setTo($recipients)
            ->setBody(
                $this->renderView(
                    $template,
                    $params
                ),
                'text/html'
            );
    
        return $this->mailer->send($message);
    }
    
    private function getRecipients($phone)
    {
        $phoneCheck = preg_replace('~\D+~','',$phone);
        
        $recipients = $this->email_addresses['dev'];
        if(!stristr($phoneCheck,'71111111111')){
            $recipients = array_merge($recipients,$this->email_addresses['work']);
        }
        return $recipients;
    }
}