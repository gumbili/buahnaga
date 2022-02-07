<?php

namespace Gumbili\Jambu\System;

use Gumbili\Jambu\System\Router\Router;

class Jambu
{
    public function start()
    {
        require_once __DIR__ . '/../app/Config/routes.php';

        Router::run();
    }
}
