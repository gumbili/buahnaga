<?php

namespace Gumbili\Jambu\App\Controllers;

use Gumbili\Jambu\System\Http\Request\Request;
use Gumbili\Jambu\System\View\View;

class Hello
{
    public function index()
    {
        return View::render('hello/index');
    }

    public function simpan(Request $request)
    {
        var_dump($request->post());
    }
}
