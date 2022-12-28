<?php
namespace TinyRouter\Routes;

class Route 
{
    /**
     * Route Get Function
     * 
     * @param string $uri
     * @param callable $callback
     * @return void
     */
    public static function get(string $uri, callable $callback)
    {
        $allowedRequestMethod = 'GET';
        $request = $_SERVER['REQUEST_URI'];
        // Make sure that uri has slash
        if(substr($uri, 0, 1) !== "/")
        {
            $uri = "/" . $uri;
        }

        if($request === $uri && $_SERVER['REQUEST_METHOD'] === $allowedRequestMethod)
        {
            return $callback();
        }

        http_response_code(405);
    }

    /**
     * Route Post Function
     * 
     * @param string $uri
     * @param callable $callback
     * @return void
     */
    public static function post(string $uri, callable $callback)
    {
        $allowedRequestMethod = 'POST';
        $request = $_SERVER['REQUEST_URI'];
        // Make sure that uri has slash
        if(substr($uri, 0, 1) !== "/")
        {
            $uri = "/" . $uri;
        }

        if($request === $uri && $_SERVER['REQUEST_METHOD'] === $allowedRequestMethod)
        {
            return $callback();
        }

        http_response_code(405);
    }
}