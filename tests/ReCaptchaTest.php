<?php

class ReCaptchaTest extends PHPUnit_Framework_TestCase
{
   
    private $reCaptcha;
    
    public function setUp()
    {
        $this->reCaptcha=new \DevStrefa\ReCaptcha\ReCaptcha(new \DevStrefa\ReCaptcha\Senders\CurlSender(), 'test_secret_key');
    }
    
    public function testConstructorIncorrectSecretKey()
    {
        $this->expectException(InvalidArgumentException::class);
        
        $sender=new \DevStrefa\ReCaptcha\Senders\CurlSender();
        $reCaptchaTmp=new DevStrefa\ReCaptcha\ReCaptcha($sender, '');
        
    }
    
    public function testGetSetSecretKey()
    {
        $this->reCaptcha->setSecretKey('test_secret');
        $this->assertEquals('test_secret',$this->reCaptcha->getSecretKey());
    }
    
}