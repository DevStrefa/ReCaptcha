<?php

use \DevStrefa\ReCaptcha\Senders\FgcSender;
   
class FgcSenderTest extends \PHPUnit_Framework_TestCase
{
    
    public function testSendIsReturnResponseObject()
    {
        $sender=new FgcSender();
        $class=new \DevStrefa\ReCaptcha\Response('{}');
        $this->assertInstanceOf(get_class($class),$sender->send('test', 'test', '127.0.0.1'));
        
    }
    
    
    
}