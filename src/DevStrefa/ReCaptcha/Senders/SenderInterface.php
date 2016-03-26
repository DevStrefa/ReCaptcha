<?php

namespace DevStrefa\ReCaptcha\Senders;

/**
 * This interface must be implemented by every Sender Class in library
 * 
 * @author Cichy <d3ut3r@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @version 1.0.0
 */
interface SenderInterface
{
    /**
     * Every Sender must implement this method it always should return Response object
     * 
     * @param string $secretKey
     * @param string $userResponse
     * @param string $userIP
     */
    public function send($secretKey,$userResponse,$userIP);
}
