<?php

use DevStrefa\ReCaptcha\ReCaptcha;
   
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
     */
    public function testInvalidSecretKeyInConstructor($key)
    {
        $this->expectException(InvalidArgumentException::class);                
        $reCaptcha=new ReCaptcha($key);
        
    }
    
    /**
     * @dataProvider invalidResponseProvider
     */
    public function testInvalidResponseSet($response)
    {
        $this->expectException(InvalidArgumentException::class);                
        $reCaptcha=new ReCaptcha('secret');
        $reCaptcha->setResponse($response);
    }
    
    /**
     * @dataProvider invalidIpProvider
     */
    public function testInvalidIpSet($ipAddress)
    {
        $this->expectException(InvalidArgumentException::class);                
        $reCaptcha=new ReCaptcha('secret');
        $reCaptcha->setRemoteIp($ipAddress);
    }
    
}