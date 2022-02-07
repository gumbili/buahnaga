<?php

namespace Gumbili\Jambu\System\Http\Response;

class Redirect
{
    public static function to($route)
    {
        header('Location: ' . $route);
        exit;
    }
}
