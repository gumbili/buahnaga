<?php

namespace Gumbili\BuahNaga\System\View;

use Gumbili\Rangkai\Rangkai;

class View
{
    public static function render(string $view, $data = [])
    {
        $rangkai = new Rangkai(VIEWS_PATH);
        $rangkai->setData($data);
        return $rangkai->render($view);
    }
}
