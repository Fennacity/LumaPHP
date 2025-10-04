<?php

namespace Framework\Routing;

class Routes
{
    // Holds all registered routes
    private $routes = [];

    /**
     * Adds a new route to the routes array.
     *
     * @param string $method  The HTTP method (GET, POST, etc.)
     * @param string $path    The URI path (e.g., /post/{id})
     * @param string $handler The controller and action (e.g., App\Controllers\PostController@show)
     */
    public function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method), // Ensure method is uppercase
            'path' => $path,                 // The route path
            'handler' => $handler            // The controller@action handler
        ];
    }

    /**
     * Returns all registered routes.
     *
     * @return array The array of routes
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
