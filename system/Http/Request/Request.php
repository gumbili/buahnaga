<?php

namespace Gumbili\BuahNaga\System\Http\Request;

class Request
{
    private $server;
    private $request;
    private $get;
    private $post;
    private $cookie;

    public function __construct($server, $request, $get, $post, $cookie)
    {
        $this->server = $server;
        $this->request = $request;
        $this->get = $get;
        $this->post = $post;
        $this->cookie = $cookie;
    }

    public function port()
    {
        return $this->server['SERVER_PORT'];
    }

    public function query(string $key = null)
    {
        if ($key) {
            if (isset($this->get[$key])) {
                return $this->get[$key];
            }
            return null;
        }

        return (object) $this->get;
    }

    public function post(string $key = null)
    {
        if ($key) {
            if (isset($this->post[$key])) {
                return $this->post[$key];
            }
            return null;
        }
        return (object) $this->post;
    }

    public function cookie(string $key = null)
    {
        if ($key) {
            if (isset($this->cookie[$key])) {
                return $this->cookie[$key];
            }
            return null;
        }
        return (object) $this->cookie;
    }
}
