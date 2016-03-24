<?php
require_once '../vendor/autoload.php';

if (isset($_POST['recaptchaTest']))
{
    try
    {

        $reCaptcha = new \DevStrefa\ReCaptcha\ReCaptcha('6LfZnRsTAAAAAKOUxOccMH-zAuLX4va82KtXD01W', new DevStrefa\ReCaptcha\Senders\FgcSender());
        
        $reCaptcha->setResponse(isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '');
        
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