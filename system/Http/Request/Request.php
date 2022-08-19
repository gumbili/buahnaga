<?php

namespace Gumbili\BuahNaga\System\Http\Request;

class Request
{
    private $server;
    private $request;
    private $gets;
    private $posts;
    private $cookies;
    private $params;

    public function __construct($server, $request, $gets, $posts, $cookies, $params)
    {
        $this->server = $server;
        $this->request = $request;
        $this->gets = $gets;
        $this->posts = $posts;
        $this->cookies = $cookies;
        $this->params = $params;
    }

    public function port()
    {
        return $this->server['SERVER_PORT'];
    }

    public function queries(string $key = null)
    {
        if ($key) {
            if (isset($this->gets[$key])) {
                return $this->gets[$key];
            }
            return null;
        }

        return (object) $this->gets;
    }

    public function posts(string $key = null)
    {
        if ($key) {
            if (isset($this->posts[$key])) {
                return $this->posts[$key];
            }
            return null;
        }
        return (object) $this->posts;
    }

    public function cookies(string $key = null)
    {
        if ($key) {
            if (isset($this->cookies[$key])) {
                return $this->cookies[$key];
            }
            return null;
        }
        return (object) $this->cookies;
    }

    public function params(string $key = null)
    {
        if ($key) {
            if (isset($this->params->$key)) {
                return $this->params->$key;
            }
            return null;
        }

        return $this->params;
    }
}
