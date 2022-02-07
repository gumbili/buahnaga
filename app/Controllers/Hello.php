<?php

namespace Gumbili\BuahNaga\App\Controllers;

use Gumbili\BuahNaga\System\Http\Request\Request;
use Gumbili\BuahNaga\System\Http\Response\Redirect;
use Gumbili\BuahNaga\System\View\View;

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

    public function pindah()
    {
        return Redirect::route('hello.simpan');
    }
}
