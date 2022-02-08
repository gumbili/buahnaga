<?php

namespace Gumbili\BuahNaga\System\View;

use League\Plates\Engine as PlatesEngine;

use function Gumbili\BuahNaga\System\route;

class View
{
    public static function render(string $view, $data = [])
    {
        $platesEngine = new PlatesEngine(VIEWS_PATH);

        $platesEngine->registerFunction('route', function (string $name, array $params = []) {
            return route($name, $params);
        });

        return $platesEngine->render($view, $data);
    }
}
