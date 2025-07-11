<?php

namespace Framework\Routing;

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
}