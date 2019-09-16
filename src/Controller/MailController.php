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
    
    
    public function __construct(
        
        RecipientResolverService $recipient_resolver,
        MailJsonResponse $response,
        MailSenderService $mail_sender
    ) {
        $this->response           = $response;
        $this->recipient_resolver = $recipient_resolver;
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
                $request->toArray()
            );
        } catch (Error $e){
            return $this->response->fail([$e->getMessage()]);
        }
    
        return $this->response->success("Спасибо, отправлено");
    }
    
}