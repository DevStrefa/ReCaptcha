<?php 

namespace DevStrefa\ReCaptcha;

class Response
{
    
    private $success;
    private $date;
    private $hostname;
    private $errors;
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
    
    public function getDate()
    {
        return new \DateTime($this->date);
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function getErrors()
    {
        return $this->errors;
    }
    
    public function isSuccess()
    {
        return (boolean)$this->success;
    }
    
    public function getRaw()
    {
        return $this->raw;
    }


    
}