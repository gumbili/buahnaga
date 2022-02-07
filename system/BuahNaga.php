<?php

namespace Gumbili\BuahNaga\System;

use Gumbili\BuahNaga\System\Router\Router;

class BuahNaga
{
    public function start()
    {
        require_once APP_PATH . '/Config/Routes.php';

        Router::run();
    }
}
