<?php 
/**
 * PHP ReCaptcha implementation
 * 
 * Main purpose of this library is develop an easy way to use ReCaptcha anti spam mechanism in PHP
 * Library use new way of validating user input according to official documentation of ReCaptcha V2.0
 * 
 * @author Cichy <d3ut3r@gmail.com>
 * @version 0.1.0
 */

namespace DevStrefa\ReCaptcha;

/**
 * Main Class
 */
class ReCaptcha
{

    /**
     *
     * @var string User Secret Key generated on google developer console
     */
    private $secretKey;
    /**
     *
     * @var string User Response string for captcha. 
     */
    private $userResponse;
    
    /**
     *
     * @var string Optional IP Address of user
     */
    private $ipAddress;

    /**
     * Constructor of main class 
     * 
     * You should pass here secretKey argument
     * 
     * @param string User Secret Key generated on google developer console
     * @throws Exception Exception is throw when secret key is empty
     */
    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;

        //TODO: Check if there is some validation rule for secret key
        if ($this->secretKey == '')
        {
            throw new Exception('Invalid Secret Key');
        }
    }
    
    /**
     * This method set User Response for validation
     *      
     * @param string User Response (for example from $_POST table)
     */
    public function setUserResponse($response)
    {
        $this->userResponse = $response;
    }

    /**
     * 
     * @param string User Ip Address
     */
    public function setUserIp($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * Verify User Response
     * 
     * In case that Captcha Isn't solve You can use GetResponse method to get more info about errors
     *  
     * @param \ReCaptcha\Senders\SenderInterface $sender
     * @return boolean TRUE if captcha is solved FALSE in other case
     */
    public function verify(DevStrefa\ReCaptcha\Senders\SenderInterface $sender)
    {
        
        
       
    }
}
