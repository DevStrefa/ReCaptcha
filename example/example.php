<?php
require_once '../vendor/autoload.php';

use \DevStrefa\ReCaptcha\ReCaptcha;
use DevStrefa\ReCaptcha\Senders\FgcSender;


if (isset($_POST['recaptchaTest']))
{
    try
    {
        
        //Remember to change default key to your own (this key is test key and it's always return valid captcha response        
        $reCaptcha = new ReCaptcha('6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe', new FgcSender());
        
        $reCaptcha->setResponse(isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'].'aaa' : '');
        $response=$reCaptcha->verify();
        
        if ($response->isSuccess())
        {
            echo 'Captcha OK';
        }
        else
        {
            echo 'Captcha Not OK';
            echo '<pre>Errors: '.print_r($response->getErrors(),true).'<br />';
            var_dump($response->getDate()).'<br />';
            echo 'Raw Response: '.$response->getRaw().'<br />';
            echo 'Hostname: '.$response->getHostname().'<br /></pre>';
        }
        
    }
    catch (\Exception $e)
    {
        echo $e->getMessage();
        exit;
    }
}