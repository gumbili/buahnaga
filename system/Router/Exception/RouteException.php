<?php

namespace Gumbili\BuahNaga\System\Router\Exception;

use Gumbili\BuahNaga\System\Exception\Exception;

class RouteException extends Exception
{
    public static function forIvalidRouteParameter(string $message = null)
    {
        if (!$message) {
            $message = 'Invalid route parameter';
        }
        throw new static($message);
    }

    public static function forRouteNotFound(string $message = null)
    {
        if (!$message) {
            $message = 'Route with defined name was not found';
        }
        throw new static($message);
    }
}
