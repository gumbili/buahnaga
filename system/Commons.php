<?php

use Gumbili\BuahNaga\System\Router\Router;

function route(string $name, array $params = [])
{
    return Router::route($name, $params);
}

function is_associative(array $array)
{
    if ([] === $array) {
        return true;
    }

    if (array_keys($array) !== range(0, count($array) - 1)) {
        return true;
    }
    return false;
}
