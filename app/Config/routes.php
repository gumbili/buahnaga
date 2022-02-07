<?php

namespace Gumbili\BuahNaga\App\Config;

use Gumbili\BuahNaga\System\Router\Router;
use Gumbili\BuahNaga\App\Controllers\Hello;

Router::get('/', Hello::class, 'index', ['name' => 'hello.index']);
Router::post('/simpan', Hello::class, 'simpan', ['name' => 'hello.simpan']);
Router::get('/pindah', Hello::class, 'pindah', ['name' => 'hello.pindah']);
