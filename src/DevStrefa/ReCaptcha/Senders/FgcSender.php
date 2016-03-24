<?php
/**
 * File Get Contents Sender
 * 
 * This is very simple implementation of SenderInterface it's using php file_get_contents function to get response from reCaptcha endpoint
 * @author Cichy <d3ut3r@gmail.com>  
 */
namespace DevStrefa\ReCaptcha\Senders;

use DevStrefa\ReCaptcha\Response;

class FgcSender implements \DevStrefa\ReCaptcha\Senders\SenderInterface
{
    const ENDPOINT='https://www.google.com/recaptcha/api/siteverify';

    public function __construct()
    {
        //check for allow_url_fopen
        if (!ini_get('allow_url_fopen'))
        {
            throw new \RuntimeException('You can\'t Use FgcSender due to disabled allow_url_fopen option in your php configuration');
        }
    }

    /**
     * Make request and return Response Object
     * 
     * @param string $secret
     * @param string $response
     * @param string $remoteIp
     * @return Response Response Object
     */
    public function send($secret, $response, $remoteIp)
    {

        $postData = array(
            'secret' => $secret,
            'response' => $response,
        );

        if (!empty($remoteIp))
        {
            $postData['remoteip'] = $remoteIp;
        }

        $context_options = array(
            'http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($postData)
                )
        );
        
        $context=  stream_context_create($context_options);
        return new Response(file_get_contents(self::ENDPOINT,FALSE,$context));
    }
}
