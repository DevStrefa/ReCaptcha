<?php
namespace DevStrefa\ReCaptcha\Senders;

use DevStrefa\ReCaptcha\Response;

/**
 * File Get Contents Sender
 * 
 * This is very simple implementation of SenderInterface it's using php file_get_contents function to get response from reCaptcha endpoint
 * 
 * @author Cichy <d3ut3r@gmail.com>  
 * @license https://opensource.org/licenses/MIT MIT
 */
class FgcSender implements \DevStrefa\ReCaptcha\Senders\SenderInterface
{
    /**
     * Contains url to google verify service
     */
    const ENDPOINT='https://www.google.com/recaptcha/api/siteverify';

    
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
