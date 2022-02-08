<?php

namespace Gumbili\BuahNaga\System\Exception;

use Gumbili\BuahNaga\System\View\View;

class GeneralException extends Exception
{
    public function __construct(string $message = null, $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous = null);
        http_response_code($code);
        echo View::render('error/general', [
            'code' => ($code) ? $code : $this->getCode(),
            'message' => ($message) ? $message : $this->getMessage(),
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'trace' => $this->getTraceAsString(),
        ]);
        exit;
    }
}
