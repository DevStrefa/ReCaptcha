<?php 
namespace DevStrefa\ReCaptcha;

use DevStrefa\ReCaptcha\Senders\SenderInterface;

/**
 * Main library class 
 * 
 * @author Cichy <d3ut3r@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */
class ReCaptcha
{

    /**
     *
     * @var string secret_key generated in Google reCaptcha panel
     */
    private $secret;
    
    /**
     *
     * @var SenderInterface Sender Object (must implement SenderInterface)
     */
    private $sender;
    
    /**
     *
     * @var string Remote IP Address
     */
    private $remoteIp;
    
    /**
     *
     * @var string Response for example from $_POST array 
     */
    private $response;

    /**
     * 
     * @param string secret_key generated in Google reCaptcha panel
     * @param SenderInterface Sender object (if null FgcSender will be used)
     * @throws \InvalidArgumentException
     */
    public function __construct($secret, SenderInterface $sender = null)
    {
        
        if (empty($secret) || !is_string($secret))
        {
            throw new \InvalidArgumentException('Invalid value of secret key.');
        }
        
        $this->secret=$secret;
        
        if (!isset($sender))
        {          
           $this->sender=new Senders\FgcSender();           
        }
        else
        {
            $this->sender=$sender;
        }
        
    }
    
    /**
     * Setting response of captcha to verify.
     * 
     * @param string $response
     * @return \DevStrefa\ReCaptcha\ReCaptcha
     * @throws \InvalidArgumentException
     */
    public function setResponse($response)
    {
        if (empty($response) || !is_string($response))
        {
            throw new \InvalidArgumentException('Invalid value for g-recaptcha-response');
        }
        
        $this->response=$response;
        return $this;
        
    }
    
    /**
     * Setting Remote IP Address (optional)
     * 
     * @param string $remoteIp
     * @return \DevStrefa\ReCaptcha\ReCaptcha
     * @throws \InvalidArgumentException
     */
    public function setRemoteIp($remoteIp)
    {
        if (!filter_var($remoteIp,FILTER_VALIDATE_IP))
        {
            throw new \InvalidArgumentException('Invalid IP address');
        }
        
        $this->remoteIp=$remoteIp;
        
        return $this;
    }
    
    /**
     * Verify given response by using sender provided in constructor. 
     * @return Response Response Object
     */
    public function verify()
    {
        return $this->sender->send($this->secret,$this->response,$this->remoteIp);
    }
    
    
    
    
}
