<?php

namespace Gumbili\BuahNaga\System\Exception\Http;

use Gumbili\BuahNaga\System\Exception\Exception;
use Gumbili\BuahNaga\System\View\View;

class PageNotFoundException extends Exception
{
    public function __construct(string $message = null)
    {
        http_response_code(404);
        echo View::render('error/404', [
            'code' => 404,
            'message' => ($message) ? $message : 'Page Not Found',
        ]);
        exit;
    }
}
