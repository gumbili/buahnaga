<?php

namespace Gumbili\BuahNaga\System\Exception;

use \Throwable;
use \Exception as PHPException;
use Gumbili\BuahNaga\System\View\View;

class Exception
{
    public function __construct(string $message = null, $code = 0, Throwable $previous = null)
    {
        throw new PHPException($message, $code, $previous);
        // http_response_code($code);
        // echo View::render('error/general', [
        //     'code' => ($code) ? $code : $this->getCode(),
        //     'message' => ($message) ? $message : $this->getMessage(),
        //     'file' => $this->getFile(),
        //     'line' => $this->getLine(),
        //     'trace' => $this->getTraceAsString(),
        // ]);
    }
}
