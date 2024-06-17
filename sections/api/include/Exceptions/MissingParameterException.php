<?php

namespace Exceptions;

use PHPMailer\PHPMailer\Exception;
use Throwable;

class MissingParameterException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->message = 'Missing parameter "' . $message . '"';
        parent::__construct($message, $code, $previous);
    }
}