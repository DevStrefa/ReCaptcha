<?php
namespace DevStrefa\ReCaptcha;

/**
 * Response class is used to store response from google reCaptcha service. 
 * 
 * @author Cichy <d3ut3r@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @version 1.0.0
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
        $responseObject=json_decode((string)$jsonData, FALSE, 3);

        if (FALSE === is_object($responseObject))
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
     * Return PHP DateTIme object of challenge timestamp from google response, if this response do not contain challenge_ts field it will return current date and time
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
        return (array)$this->errors;
    }
    
    /**
     * 
     * @return boolean Result of challenge
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