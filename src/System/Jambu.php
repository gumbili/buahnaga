<?php

namespace Gumbili\Jambu\System;

use Gumbili\Jambu\System\Router\Router;

class Jambu
{
    public function start()
    {
        require_once __DIR__ . '/../App/Config/routes.php';

        Router::run();
    }
}
