<?php

namespace Gumbili\Jambu\System\Exception\Http;

use Gumbili\Jambu\System\Exception\Exception;
use Gumbili\Jambu\System\View\View;

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
