<?php

namespace Gumbili\BuahNaga\System\Http\Response;

class Redirect
{
    public static function to($route)
    {
        header('Location: ' . $route);
        exit;
    }

    public static function route($name)
    {
        self::to(route($name));
    }
}
