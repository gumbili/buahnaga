<?php

namespace Gumbili\BuahNaga\App\Controllers;

use Gumbili\BuahNaga\System\Exception\GeneralException;
use Gumbili\BuahNaga\System\Http\Request\Request;
use Gumbili\BuahNaga\System\Http\Response\Redirect;
use Gumbili\BuahNaga\System\View\View;

use function Gumbili\BuahNaga\System\route;

class Hello
{
    public function index()
    {
        var_dump(route('hello.placeholdera', ['nama' => 'mawar']));
    }

    public function placeholder(Request $request)
    {
        var_dump($request->params());
    }

    public function about()
    {
        return 'Halaman about';
    }
}
