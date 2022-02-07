<?php

namespace Gumbili\BuahNaga\System;

use Gumbili\BuahNaga\System\Router\Router;

if (!function_exists('route')) {
    function route(string $name, array $params = [])
    {
        $routeList = Router::list();

        foreach ($routeList as $route) {
            if (isset($route['options']['name'])) {
                if ($route['options']['name'] === $name) {
                    return $route['path'];
                }
            }
        }
        return;
    }
}
