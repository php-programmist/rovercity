<?php

namespace App\Controller;

use App\Request\CallbackFormRequest;
use App\Response\MailJsonResponse;
use App\Service\MailSenderService;
use App\Service\RecipientResolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Error\Error;

class MailController extends AbstractController
{
    
    /**
     * @var MailJsonResponse
     */
    protected $response;
    /**
     * @var RecipientResolverService
     */
    protected $recipient_resolver;
    /**
     * @var MailSenderService
     */
    protected $mail_sender;
    
    private $email_addresses;
    
    public function __construct(
        
        RecipientResolverService $recipient_resolver,
        MailJsonResponse $response,
        MailSenderService $mail_sender,
        ParameterBagInterface $params
    ) {
        $this->response           = $response;
        $this->recipient_resolver = $recipient_resolver;
        $this->email_addresses    = $params->get('email_addresses');
        $this->mail_sender        = $mail_sender;
    }
    
    public function callback(CallbackFormRequest $request)
    {
        $template   = 'emails/callback.html.twig';
        $recipients = $this->recipient_resolver->getRecipients($request->getPhone());
        try{
            $this->mail_sender->sendMail(
                $recipients,
                $request->getSubject(),
                $template,
                $request->toArray(),
                $this->email_addresses['from']
            );
        } catch (Error $e){
            return $this->response->fail([$e->getMessage()]);
        }
    
        return $this->response->success("Спасибо, отправлено");
    }
    
}