<?php

namespace DevStrefa\ReCaptcha\Senders;

interface SenderInterface
{
    public function send($secretKey,$userResponse,$userIP);
}
