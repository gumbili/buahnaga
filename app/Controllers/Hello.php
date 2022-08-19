<?php

namespace Gumbili\BuahNaga\App\Controllers;

use Gumbili\BuahNaga\System\View\View;
use Gumbili\BuahNaga\System\Http\Request\Request;


class Hello extends Controller
{
    public function index()
    {
        var_dump(route('hello.user', ['rizky']));
        var_dump(route('hello.index'));
        // return View::render('hello/index', ['nama' => 'Rizky Kurniawan']);
    }

    public function user(Request $request)
    {
        var_dump($request->params());
    }

    public function about()
    {
        return 'Halaman about';
    }

    public function certificateDetail(Request $request)
    {
        var_dump($request->params());
    }

    public function submit(Request $request)
    {

    }
}
