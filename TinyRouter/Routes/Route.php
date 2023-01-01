<?php
namespace TinyRouter\Routes;

class Route 
{
    /**
     * Route Get Function
     * 
     * @param string $uri
     * @param callable $callback
     * @return mixed|void
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

        // Handle uri parameters
        $requestArguments = array_values(array_filter(explode('/', $request), fn($value) => $value !== ""));
        $uriParameters = array_values(array_filter(explode('/', $uri), fn($element) => substr($element, 0, 1) === '{'));

        if(count($uriParameters) > 0)
        {
            // Remove first argument from request uri to count only parameter catched by server
            unset($requestArguments[array_key_first($requestArguments)]);
            if(count($requestArguments) !== count($uriParameters))
            {
                header("HTTP/1.1 404 Not Found");
                return;
            }

            return $callback();
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

        // Handle uri parameters
        $requestArguments = array_values(array_filter(explode('/', $request), fn($value) => $value !== ""));
        $uriParameters = array_values(array_filter(explode('/', $uri), fn($element) => substr($element, 0, 1) === '{'));

        if(count($uriParameters) > 0)
        {
            // Remove first argument from request uri to count only parameter catched by server
            unset($requestArguments[array_key_first($requestArguments)]);
            if(count($requestArguments) !== count($uriParameters))
            {
                header("HTTP/1.1 404 Not Found");
                return;
            }

            return $callback();
        }

        if($request === $uri && $_SERVER['REQUEST_METHOD'] === $allowedRequestMethod)
        {
            return $callback();
        }

        http_response_code(405);
    }
}