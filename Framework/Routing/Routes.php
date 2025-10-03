<?php

namespace Framework\Routing;

class Routes
{
    private $routes = [];

    public function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
