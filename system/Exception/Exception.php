<?php

namespace Gumbili\Jambu\System\Exception;

use \Throwable;
use \Exception as PHPException;

class Exception extends PHPException
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
