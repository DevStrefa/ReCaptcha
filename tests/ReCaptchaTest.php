<?php

use \DevStrefa\ReCaptcha\ReCaptcha;
   
class ReCaptchaTest extends \PHPUnit_Framework_TestCase
{
    
    private $reCaptcha;
    
    public static function invalidKeysProvider()
    {
        return array(
            
            array(''),
            array(-10),
            array(array()),
            array(new \stdClass()),
            array(false)
            
        );
    }
    
    public static function invalidResponseProvider()
    {
        return array(
            
            array(''),
            array(-10),
            array(array()),
            array(new \stdClass()),
            array(false)
            
        );
    }
    
    public static function invalidIpProvider()
    {
        return array(
            array(''),
            array(-10),
            array(array()),
            array(new \stdClass()),
            array(false),
            array('127.0.'),
            array('f3:3ad:das')
        );
    }
    
    
    /**
     * @dataProvider invalidKeysProvider
     * @expectedException InvalidArgumentException
     */
    public function testInvalidSecretKeyInConstructor($key)
    {
        
        $reCaptcha=new ReCaptcha($key);
        
    }
    
    /**
     * @dataProvider invalidResponseProvider
     * @expectedException InvalidArgumentException 
     */
    public function testInvalidResponseSet($response)
    {                  
        $reCaptcha=new ReCaptcha('secret', new \DevStrefa\ReCaptcha\Senders\FgcSender());
        $reCaptcha->setResponse($response);
    }
    
    /**
     * @dataProvider invalidIpProvider
     * @expectedException InvalidArgumentException
     */
    public function testInvalidIpSet($ipAddress)
    {     
        $reCaptcha=new ReCaptcha('secret');
        $reCaptcha->setRemoteIp($ipAddress);
    }
    
    public function testValidIpSet()
    {
        $reCaptcha=new ReCaptcha('secret');        
        $this->assertInstanceOf(get_class($reCaptcha), $reCaptcha->setRemoteIp('127.0.0.1'));
    }
    
    public function testValidResponseSet()
    {
        $reCaptcha=new ReCaptcha('secret');        
        $this->assertInstanceOf(get_class($reCaptcha), $reCaptcha->setResponse('some_secret_string_response_token'));
    }
    
    public function testValidResponseReturnedFromVerify()
    {
        $reCaptcha=new ReCaptcha('secret');
        
        $response=$reCaptcha->setResponse('test_response')->verify();
        
        $this->assertInstanceOf(get_class($response),$response);
        
    }
    
}