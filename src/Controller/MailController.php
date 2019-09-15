<?php

namespace App\Controller;

use App\Request\CallbackFormRequest;
use App\Request\MailRequestInterface;
use App\Response\MailJsonResponse;
use App\Service\RecipientResolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailController extends AbstractController
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;
    /**
     * @var MailJsonResponse
     */
    protected $response;
    /**
     * @var RecipientResolverService
     */
    protected $recipient_resolver;
    
    private $email_addresses;
    
    public function __construct(
        \Swift_Mailer $mailer,
        RecipientResolverService $recipient_resolver,
        MailJsonResponse $response,
        ParameterBagInterface $params
    ) {
        $this->mailer             = $mailer;
        $this->response           = $response;
        $this->recipient_resolver = $recipient_resolver;
        $this->email_addresses    = $params->get('email_addresses');
    }
    
    public function callback(CallbackFormRequest $request)
    {
        $template = 'emails/callback.html.twig';
        $this->sendMail($template, $request);
        return $this->response->success("Спасибо, отправлено");
    }
    
    /**
     * @param string               $template
     * @param MailRequestInterface $request
     *
     * @return int
     */
    private function sendMail(string $template, MailRequestInterface $request)
    {
        $recipients = $this->recipient_resolver->getRecipients($request->getPhone());
        
        $message = (new \Swift_Message($request->getSubject()))
            ->setFrom($this->email_addresses['from'])
            ->setTo($recipients)
            ->setBody(
                $this->renderView(
                    $template,
                    ['request' => $request]
                ),
                'text/html'
            );
        
        return $this->mailer->send($message);
    }
    
}