<?php

namespace Gumbili\BuahNaga\System\Router;

use Gumbili\BuahNaga\System\Exception\Http\PageNotFoundException;
use Gumbili\BuahNaga\System\Http\Request\Request;

class RouteCollection
{
    private static $instance = null;
    private array $routes = [];

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new RouteCollection();
        }
        return self::$instance;
    }

    public function add(string $requestMethod, string $path, string $controller, string $method = null, array $options = []): void
    {
        $this->routes[] = [
            'request_method' => strtoupper($requestMethod),
            'path' => $this->sanitizePath($path),
            'controller' => $controller,
            'method' => $method,
            'options' => $options
        ];
    }

    public function run()
    {
        $path = '/';
        $params = [];
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        foreach ($this->routes as $route) {
            $routePath = $route['path'];
            $pathInfo = $this->sanitizePath($path);

            if (preg_match_all('^:.*?\/^', $routePath, $placeholders)) {
                $routePathExplode = explode('/', $routePath);
                $pathInfoExplode = explode('/', $pathInfo);
                if (count($routePathExplode) == count($pathInfoExplode)) {
                    $placeholders = $placeholders[0];
                    $placeholders = array_map(function ($placeholder) {
                        return rtrim($placeholder, '/');
                    }, $placeholders);

                    foreach ($placeholders as $placeholder) {
                        $placeHolderIndex = array_search($placeholder, $routePathExplode);
                        $routePathExplode[$placeHolderIndex] = $pathInfoExplode[$placeHolderIndex];
                        $params[ltrim($placeholder, ':')] = $pathInfoExplode[$placeHolderIndex];
                    }

                    $routePath = implode('/', $routePathExplode);
                    if ($routePath == '//') $routePath = '/';

                    $requestMethod = $_SERVER['REQUEST_METHOD'];

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

                        $request = new Request($_SERVER, $_REQUEST, $_GET, $_POST, $_COOKIE, (object)$params);

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
            } else {

                $requestMethod = $_SERVER['REQUEST_METHOD'];

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

                    $request = new Request($_SERVER, $_REQUEST, $_GET, $_POST, $_COOKIE, (object)$params);

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
        }

        throw new PageNotFoundException();
    }

    public function list()
    {
        return $this->routes;
    }

    public function extractPlaceholders($routePath)
    {
        preg_match_all('^:.*?\/^', $routePath, $placeholders);
        $placeholders = array_map(function ($placeholder) {
            return rtrim(ltrim($placeholder, ':'), '/');
        }, $placeholders[0]);
        return $placeholders;
    }

    private function sanitizePath($path)
    {
        if ($path[0] !== '/') {
            $path = '/' . $path;
        }

        if ($path[strlen($path) - 1] !== '/') {
            $path .= '/';
        }

        return $path;
    }
}
