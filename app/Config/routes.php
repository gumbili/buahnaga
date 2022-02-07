<?php

use Gumbili\Jambu\System\Router\Router;
use Gumbili\Jambu\App\Controllers\Hello;

Router::add('GET', '/', Hello::class, 'index');
