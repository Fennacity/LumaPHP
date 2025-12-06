<?php

namespace Luma\Routing;

class Routes
{
    // Holds all registered routes
    private array $routes = [];

    /**
     * Adds a new route to the routes array.
     *
     * @param string $method  The HTTP method (GET, POST, etc.)
     * @param string $path    The URI path (e.g., /post/{id})
     * @param string $handler The controller and action (e.g., App\Controllers\PostController@show)
     * @param string $title   The title for the route (used in navigation)
     * @param bool   $inNav   Whether to include this route in navigation
     */
    public function addRoute(string $method, string $path, string $handler, string $title, bool $inNav = false): void
    {
        $this->routes[] = [
            'method' => strtoupper($method), // Ensure method is uppercase
            'path' => $path,                 // The route path
            'handler' => $handler,            // The controller@action handler
            'title' => $title ?: ucfirst(trim($path, '/')) ?: 'Home', // Title for navigation
            'inNav' => $inNav,                  // Whether to include in navigation
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
