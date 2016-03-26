<?php

use \DevStrefa\ReCaptcha\Response;
   
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    
    public static function invalidJSONProvider()
    {
        return array(
            array('{a:'),
            array('test')
        );
    }
    
    public static function validJSONProvider()
    {
        return array(
            
           array('{ "success": true, "challenge_ts": "2016-03-25T21:18:44Z", "hostname": "localhost" }'),
           array('{ "success": true, "challenge_ts": "2016-03-25T21:18:44Z", "hostname": "localhost" }'),
           array('{ "success": true,"hostname": "localhost" }')
           
            
        );
    }
    
    public static function errorJSONProvider()
    {
        return array(            
           array('{ "success": false,"error-codes": ["invalid-input-response"]}')
        );
    }
    
    /**
     * @dataProvider invalidJSONProvider
     * @expectedException RuntimeException
     */
    public function testIfConstructorThrowException($jsonData)
    {
        $response=new Response($jsonData);
        
    }
    
    /**
     * @dataProvider validJSONProvider
     */
    public function testGetDateReturnDateTimeObject($jsonData)
    {
        $response=new Response($jsonData);
        $class=new \DateTime();
        $this->assertInstanceOf(get_class($class), $response->getDate());
        
    }
    
    public function testIsSuccess()
    {
        $successResponse='{ "success": true, "challenge_ts": "2016-03-25T21:18:44Z", "hostname": "localhost" }';
        $failedResponse='{ "success": false, "challenge_ts": "2016-03-25T21:18:44Z", "hostname": "localhost" }';
        
        $response=new Response($successResponse);
        
        $this->assertTrue($response->isSuccess());
        
        $response=new Response($failedResponse);
        
        $this->assertFalse($response->isSuccess());
        
    }
    
    /**
     * @dataProvider validJSONProvider
     */   
    public function testGetHostname($jsonData)
    {
        $response=new Response($jsonData);
        $this->assertEquals('localhost',$response->getHostname());
    }
    
    /**
     * @dataProvider validJSONProvider
     */   
    public function testGetRaw($jsonData)
    {
        $response=new Response($jsonData);
        $this->assertEquals($jsonData,$response->getRaw());
    }
    
    /**
     * @dataProvider errorJSONProvider
     */   
    public function testGetErrors($jsonData)
    {
        $response=new Response($jsonData);
        $this->assertContains('invalid-input-response',$response->getErrors());
    }
    
    
}