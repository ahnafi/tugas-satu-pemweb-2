<?php

namespace todolist\App;

class Router
{
    private static array $routes = [];

    public static function Add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = [],
    ): void {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware,
        ];
    }
    
    public static function Run (){
        $path = "/";

        if (isset($_SERVER["PATH_INFO"])){
            $path = $_SERVER["PATH_INFO"];
        }

        $method = $_SERVER["REQUEST_METHOD"];

        foreach (self::$routes as $route){
            $pattern = "#^" . $route["path"] . "$#";
            if(preg_match($pattern,$path,$variables)&& $method == $route["method"]){
                $controller = new $route["controller"];
                $function = $route["function"];

                foreach ($route["middleware"] as $middleware){
                    $middleware = new $middleware;
                    $middleware->before();
                }
               
                array_shift($variables);
                call_user_func([$controller,$function],$variables);
                return;
            }
        }
        // http_response_code(404);
        View::redirect("/");
    }
}
