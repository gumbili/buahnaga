<?php

namespace Gumbili\Jambu\System\View;

use League\Plates\Engine as PlatesEngine;

class View
{
    private static $viewsPath = APP_PATH . '/Views';

    public static function render(string $view, $data = [])
    {
        $platesEngine = new PlatesEngine(self::$viewsPath);
        return $platesEngine->render($view, $data);
    }
}
