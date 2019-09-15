<?php

namespace App\EventListener;

use App\Response\MailJsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ExceptionListener
{
    /**
     * @var MailJsonResponse
     */
    protected $response;
    
    public function __construct(MailJsonResponse $response)
    {
        $this->response = $response;
    }
    
    public function onKernelException(ExceptionEvent $event)
    {
        
        $exception = $event->getException();
        
        if ($exception instanceof BadRequestHttpException) {
            $event->setResponse($this->response->fail($exception->getMessage()));
        }
    }
}