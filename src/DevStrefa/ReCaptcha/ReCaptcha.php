<?php 

namespace DevStrefa\ReCaptcha;

use DevStrefa\ReCaptcha\Senders\SenderInterface;

class ReCaptcha
{

    private $secret;
    private $sender;
    private $remoteIp;
    private $response;

    public function __construct($secret, SenderInterface $sender = null)
    {
        
        if (empty($secret) || !is_string($secret))
        {
            throw new \InvalidArgumentException('Invalid value of secret key.');
        }
        
        $this->secret=$secret;
        
        if (!isset($sender))
        {
           //TODO:resolve best sender method
        }
        else
        {
            $this->sender=$sender;
        }
        
    }
    
    public function setResponse($response)
    {
        if (empty($response) || !is_string($response))
        {
            throw new \InvalidArgumentException('Invalid value for g-recaptcha-response');
        }
        
        $this->response=$response;
        return $this;
        
    }
    
    public function setRemoteIp($remoteIp)
    {
        if (!filter_var($remoteIp,FILTER_VALIDATE_IP))
        {
            throw new \InvalidArgumentException('Invalid IP address');
        }
        
        $this->remoteIp=$remoteIp;
        
        return $this;
    }
    
    
    public function verify()
    {
        return $this->sender->send($this->secret,$this->response,$this->remoteIp);
    }
    
    
    
    
}
