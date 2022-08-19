<?php

namespace Gumbili\BuahNaga\System\Http\Exception;

use Gumbili\BuahNaga\System\Exception\Exception;

class ControllerException extends Exception
{
    public static function forMethodNotFound()
    {
        throw new static('Controller method not found');
    }
}
