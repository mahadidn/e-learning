<?php

namespace Klp1\ELearning;

class Router {

    private static array $routes = [];

    public static function add(string $method,
                               string $path,
                               string $controller,
                               string $function,
                               array $middleware = []): void {

            self::$routes[] = [
                'method' => $method,
                'path' => $path,
                'controller' => $controller,
                'function' => $function,
                'middleware' => $middleware
            ];
    } 

    public static function run(): void {
        $path = "/";
        if (isset($_SERVER['PATH_INFO'])){
            $path = $_SERVER['PATH_INFO'];
        }
        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes as $route){
            if ($path == $route['path'] && $method == $route['method']){
                foreach($route['middleware'] as $middleware){
                    $instance = new $middleware;
                }

                $function = $route['function'];
                $controller = new $route['controller'];

            }
        }
    }

}

