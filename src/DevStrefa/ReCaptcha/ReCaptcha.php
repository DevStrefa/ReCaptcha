<?php namespace DevStrefa\ReCaptcha;

class ReCaptcha
{

    private $secretKey;
    private $sender;
    private $userIp;
    private $userResponse;

    public function __construct(\DevStrefa\ReCaptcha\Senders\SenderInterface $sender, $secretKey)
    {

        $this->sender = $sender;
        $this->setSecretKey($secretKey);
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey($secretKey)
    {

        if ($this->getSecretKey() == '')
        {
            throw new \InvalidArgumentException('Secret Key Can\'t be empty');
        }

        $this->secretKey = $secretKey;
    }

    public function getUserIp()
    {
        return $this->userIp;
    }

    public function getUserResponse()
    {
        return $this->userResponse;
    }

    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;
        return $this;
    }

    public function setUserResponse($userResponse)
    {
        $this->userResponse = $userResponse;
        return $this;
    }
}
