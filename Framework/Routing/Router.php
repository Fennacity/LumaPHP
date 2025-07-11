<?php

namespace Framework\Routing;

class Router
{
    private $routes;

    public function __construct(Routes $routes)
    {
        $this->routes = $routes->getRoutes();
    }

    public function dispatch($method, $uri)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                [$controller, $action] = explode('@', $route['handler']);
                $controllerInstance = new $controller();
                return $controllerInstance->$action();
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
}