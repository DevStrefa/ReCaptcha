<?php
namespace DevStrefa\ReCaptcha;

/**
 * Response Object
 * 
 * Object returned after sending verify request to google service
 */

class Response
{
    /**
     *
     * @var boolean TRUE if Captcha was Solved FALSE if not 
     */
    private $success;
    /**
     *
     * @var string timestamp in ISO format yyyy-MM-dd'T'HH:mm:ssZZ 
     */
    private $date;
    
    /**
     *
     * @var string host name
     */
    private $hostname;
    
    /**
     *
     * @var array Array of errors 
     */
    private $errors;
    
    /**
     *
     * @var string  Raw JSON string form google service 
     */
    private $raw;
    
    public function __construct($jsonData)
    {
        $responseObject=json_decode($jsonData, FALSE, 3);

        if (FALSE === $responseObject)
        {
            throw new \RuntimeException('Invalid format of response (it\'s not JSON as expected)');
        }
        
        $this->raw = $jsonData;
        $this->success=isset($responseObject->success) ? (boolean)$responseObject->success : FALSE;
        $this->date=isset($responseObject->challenge_ts) ? $responseObject->challenge_ts : '';
        $this->hostname=isset($responseObject->hostname) ? $responseObject->hostname : '';
        $this->errors=isset($responseObject->{'error-codes'}) ? $responseObject->{'error-codes'} : array();
        
         
    }
    
    /**
     * 
     * @return \DateTime Date object of challenge timeStamp
     */
    public function getDate()
    {
        return new \DateTime($this->date);
    }

    /**
     * 
     * @return String Hostname
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * 
     * @return array Array of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * 
     * @return bollean Result of challenge
     */
    public function isSuccess()
    {
        return (boolean)$this->success;
    }
    
    /**
     * 
     * @return string Raw JSON string
     */
    public function getRaw()
    {
        return $this->raw;
    }


    
}