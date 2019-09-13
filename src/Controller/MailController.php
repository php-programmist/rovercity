<?php

namespace App\Controller;

use App\Validator\EmailFormValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailController extends AbstractController
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;
    
    private $email_addresses;
    
    public function __construct(\Swift_Mailer $mailer, ParameterBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->email_addresses = $params->get('email_addresses');
    }
    
    public function callback(EmailFormValidator $validator)
    {
        $response=[];
        $params = $validator->getValidatedValues(['name','phone','subject'],$errors);
        if (count($errors)) {
            $response['status'] = false;
            $response['errors'] = $errors;
            return $this->json($response);
        }
        $params['referer'] = @$_SERVER['HTTP_REFERER'];
        $template = 'emails/callback.html.twig';
        
        if (! $this->sendMail($template,$params)) {
            $response['status'] = false;
            $response['errors'] = ["Возникла ошибка во время отправки сообщения"];
        }
        else{
            $response['status'] = true;
            $response['msg'] = "Спасибо, отправлено";
        }
        return $this->json($response);
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