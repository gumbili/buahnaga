<?php

namespace Gumbili\BuahNaga\App\Config;

use Gumbili\BuahNaga\System\Router\Router;
use Gumbili\BuahNaga\App\Controllers\Hello;

Router::get('/', Hello::class, 'index', ['name' => 'hello.index']);
Router::get('/about', Hello::class, 'about', ['name' => 'hello.about']);
Router::get('/users/:username', Hello::class, 'user', ['name' => 'hello.user']);
Router::get(
    '/users/:username/certificates/:certificateId', 
    Hello::class, 
    'certificateDetail', 
    ['name' => 'hello.certificateDetail'
]);
Router::post('/submit', Hello::class, 'submit', ['name' =>'hello.submit']);
