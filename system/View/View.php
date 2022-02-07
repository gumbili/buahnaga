<?php

namespace Gumbili\BuahNaga\System\View;

use League\Plates\Engine as PlatesEngine;

class View
{
    public static function render(string $view, $data = [])
    {
        $platesEngine = new PlatesEngine(VIEWS_PATH);
        return $platesEngine->render($view, $data);
    }
}
