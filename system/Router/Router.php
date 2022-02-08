<?php

namespace Gumbili\BuahNaga\System\Router;

use Gumbili\BuahNaga\System\Exception\GeneralException;
use Gumbili\BuahNaga\System\Router\RouteCollection;

use function Gumbili\BuahNaga\System\is_associative;

class Router
{

    public static function add(string $requestMethod, string $path, string $controller, string $method = null, array $options = []): void
    {
        $routerCollection = RouteCollection::getInstance();
        $routerCollection->add($requestMethod, $path, $controller, $method, $options);
    }

    public static function get(string $path, string $controller, string $method = null, array $options = []): void
    {
        self::add('GET', $path, $controller, $method, $options);
    }

    public static function post(string $path, string $controller, string $method = null, array $options = []): void
    {
        self::add('POST', $path, $controller, $method, $options);
    }

    public static function list(): array
    {
        return RouteCollection::getInstance()->list();
    }

    public static function run(): void
    {
        RouteCollection::getInstance()->run();
    }

    public static function route(string $routeName, array $params = [])
    {
        foreach (self::list() as $route) {
            if (isset($route['options']['name'])) {
                if ($route['options']['name'] === $routeName) {
                    $placeholders = RouteCollection::getInstance()->extractPlaceholders($route['path']);
                    if (count($placeholders) > 0) {
                        if (count($params) !== count($placeholders)) {
                            throw new GeneralException('Routes need parameters');
                        }
                        $routePathExplode = explode('/', $route['path']);
                        foreach ($placeholders as $position => $placeholder) {
                            $originalPlaceholder = ':' . $placeholder;
                            $placeholderPosition = array_search($originalPlaceholder, $routePathExplode);
                            if (is_associative($params)) {
                                if (array_key_exists($placeholder, $params) === false) {
                                    throw new GeneralException("Routes need parameters: " . $placeholder);
                                }
                                $routePathExplode[$placeholderPosition] = $params[$placeholder];
                            } else {
                                $routePathExplode[$placeholderPosition] = $params[$position];
                            }
                        }
                        $routePath = implode('/', $routePathExplode);
                        return $routePath;
                    }
                    return $route['path'];
                }
            }
        }
        throw new GeneralException('Route with name [' . $routeName . '] not found.');
    }
}
