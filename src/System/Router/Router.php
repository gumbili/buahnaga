<?php

namespace Gumbili\Jambu\System\Router;

class Router
{
    private static array $routes = [];

    public static function get(string $path, string $controller, string $method = null, array $middelwares = []): void
    {
        self::$routes[] = [
            'request_method' => 'GET',
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
            'middlewares' => $middelwares
        ];
    }

    public static function run(): void
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {

            if ($requestMethod !== $route['request_method']) {
                http_response_code(404);
                echo 'Page Not Found';
            }

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

            if (preg_match($pattern, $pathInfo, $variables)) {
                foreach ($route['middlewares'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }
                $method = $route['method'];
                $controller = new $route['controller'];
                array_shift($variables);
                $result = call_user_func_array([$controller, $method], $variables);

                if (is_null($result)) {
                    return;
                }
                echo $result;
                return;
            }
        }

        http_response_code(404);
        echo 'Page Not Found';
    }
}
