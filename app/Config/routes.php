<?php

namespace Gumbili\BuahNaga\App\Config;

use Gumbili\BuahNaga\System\Router\Router;
use Gumbili\BuahNaga\App\Controllers\Hello;

Router::get('/', Hello::class, 'index', ['name' => 'hello.index']);
Router::get('/about', Hello::class, 'about', ['name' => 'hello.about']);
Router::get('/:username', Hello::class, 'placeholder', ['name' => 'hello.placeholder']);
