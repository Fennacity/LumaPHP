<?php

namespace Routing;

class Routes
{
    private $routes = [];

    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function findRoute($method, $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $path) {
                return $route['handler'];
            }
        }
        return null;
    }
}