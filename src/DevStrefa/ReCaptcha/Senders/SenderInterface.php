<?php

namespace DevStrefa\ReCaptcha\Senders;

interface SenderInterface
{
    public function send($endPoint,$secretKey,$userResponse,$userIP);
}
