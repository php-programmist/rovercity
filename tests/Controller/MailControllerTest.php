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
        $name    = 'Алексей';
        $phone   = '+7(111)111-11-11';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',
            ['name' => $name, 'phone' => $phone, 'subject' => $subject]);
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $response = @json_decode($content);
        $this->assertTrue($response->status);
        
        $mailCollector = $client->getProfile()->getCollector('swiftmailer');
        
        // checks that an email was sent
        $this->assertSame(1, $mailCollector->getMessageCount());
        
        $collectedMessages = $mailCollector->getMessages();
        $message           = $collectedMessages[0];
        
        // Asserting email data
        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertSame($subject, $message->getSubject());
        // $this->assertSame('send@example.com', key($message->getFrom()));
        $this->assertSame(['kostin@qmotors.ru' => null, 'webmaster@qmotors.ru' => null], $message->getTo());
        
        // $this->assertSame(
        //     'You should see me from the profiler!',
        //     $message->getBody()
        // );
    }
    
    public function testEmptyName()
    {
        $client = static::createClient();
        
        $subject = 'Заказ звонка';
        $name    = '';
        $phone   = '+7(111)111-11-11';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',
            ['name' => $name, 'phone' => $phone, 'subject' => $subject]);
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $response = @json_decode($content);
        $this->assertFalse($response->status);
    }
    
    public function testWrongName()
    {
        $client = static::createClient();
        
        $subject = 'Заказ звонка';
        $name    = 'jhadhhjad2';
        $phone   = '+7(111)111-11-11';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',
            ['name' => $name, 'phone' => $phone, 'subject' => $subject]);
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $response = @json_decode($content);
        $this->assertFalse($response->status);
    }
    
    public function testEmptyPhone()
    {
        $client = static::createClient();
        
        $subject = 'Заказ звонка';
        $name    = 'Алексей';
        $phone   = '';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',
            ['name' => $name, 'phone' => $phone, 'subject' => $subject]);
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $response = @json_decode($content);
        $this->assertFalse($response->status);
    }
    
    public function testWrongPhone()
    {
        $client = static::createClient();
        
        $subject = 'Заказ звонка';
        $name    = 'Алексей';
        $phone   = '111111111111';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',
            ['name' => $name, 'phone' => $phone, 'subject' => $subject]);
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $response = @json_decode($content);
        $this->assertFalse($response->status);
    }
    
    public function testEmptySubject()
    {
        $client = static::createClient();
        
        $name    = 'Алексей';
        $phone   = '+7(111)111-11-11';
        $crawler = $client->xmlHttpRequest('POST', '/mail/callback/',
            ['name' => $name, 'phone' => $phone,]);
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $response = @json_decode($content);
        $this->assertFalse($response->status);
    }
}