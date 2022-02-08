<?php

namespace Gumbili\BuahNaga\System\Router\Bac;

use Gumbili\BuahNaga\System\Exception\Http\PageNotFoundException;
use Gumbili\BuahNaga\System\Http\Request\Request;

class Router
{
    private static array $routes = [];

    public static function add(string $requestMethod, string $path, string $controller, string $method = null, array $options = []): void
    {
        self::$routes[] = [
            'request_method' => strtoupper($requestMethod),
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
            'options' => $options
        ];
    }

    public static function get(string $path, string $controller, string $method = null, array $options = []): void
    {
        self::add('GET', $path, $controller, $method, $options);
    }

    public static function post(string $path, string $controller, string $method = null, array $options = []): void
    {
        self::add('POST', $path, $controller, $method, $options);
    }

    public static function list()
    {
        return self::$routes;
    }

    public static function run(): void
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {

            $routePath = $route['path'];
            $pathInfo = $path;

            if ($routePath[0] !== '/') {
                $routePath = '/' . $routePath;
            }

            if ($routePath[strlen($routePath) - 1] !== '/') {
                $routePath .= '/';
            }

            if ($pathInfo[strlen($pathInfo) - 1] !== '/') {
                $pathInfo .= '/';
            }

            $pattern = "#^" . $routePath . "$#";

            if (preg_match($pattern, $pathInfo, $matches) && $requestMethod == $route['request_method']) {

                if (isset($route['options']['middlewares'])) {
                    foreach ($route['options']['middlewares'] as $middleware) {
                        $instance = new $middleware;
                        $instance->before();
                    }
                }

                $method = $route['method'];

                $controller = new $route['controller'];

                array_shift($matches);

                $request = new Request($_SERVER, $_REQUEST, $_GET, $_POST, $_COOKIE);

                $result = call_user_func_array([$controller, $method], [$request]);

                if (is_null($result)) {
                    return;
                }
                if (!is_object($result) && !is_array($result)) {
                    echo $result;
                }
                return;
            }
        }

        throw new PageNotFoundException();
    }
}
