<?php

use DevStrefa\ReCaptcha\Senders\FgcSender;
   
class FgcSenderTest extends \PHPUnit_Framework_TestCase
{
    
    public function testSendIsReturnResponseObject()
    {
        $sender=new FgcSender();
        $this->assertInstanceOf(DevStrefa\ReCaptcha\Response::class,$sender->send('test', 'test', '127.0.0.1'));
        
    }
    
    
    
}