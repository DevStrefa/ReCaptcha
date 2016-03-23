<?php

class ReCaptchaTest extends PHPUnit_Framework_TestCase
{
    
    public function testConstructorFail()
    {
        
        $this->expectException(InvalidArgumentException::class);
        $reCaptcha = new DevStrefa\ReCaptcha\ReCaptcha('');
        
    }
    
}
