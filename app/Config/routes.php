<?php

use Gumbili\Jambu\System\Router\Router;
use Gumbili\Jambu\App\Controllers\Hello;

Router::get('/', Hello::class, 'index');
Router::get('/about', Hello::class, 'about');
Router::get('/contact', Hello::class, 'contact');
