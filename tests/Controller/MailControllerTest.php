<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailControllerTest extends WebTestCase
{
    public function testMailIsSentAndContentIsOk()
    {
        $client = static::createClient();
        
        // enables the profiler for the next request (it does nothing if the profiler is not available)
        $client->enableProfiler();
        $subject = 'Заказ звонка';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',['name'=>'Alexey','phone'=>'71111111111','subject'=>$subject]);
        
        $mailCollector = $client->getProfile()->getCollector('swiftmailer');
        
        // checks that an email was sent
        $this->assertSame(1, $mailCollector->getMessageCount());
        
        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];
        
        // Asserting email data
        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertSame($subject, $message->getSubject());
        // $this->assertSame('send@example.com', key($message->getFrom()));
         $this->assertSame(['kostin@qmotors.ru'=>null,'webmaster@qmotors.ru'=>null], $message->getTo());
        // $this->assertSame(
        //     'You should see me from the profiler!',
        //     $message->getBody()
        // );
    }
}