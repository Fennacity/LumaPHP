<?php

namespace Luma\Routing;

class Router
{
    // Holds the array of route definitions
    private $routes;

    /**
     * Router constructor.
     * Initializes the router with the provided routes.
     *
     * @param Routes $routes The Routes object containing all route definitions
     */
    public function __construct(Routes $routes)
    {
        $this->routes = $routes->getRoutes();
    }

    /**
     * Dispatches the request to the appropriate controller and action.
     * Supports route parameters (e.g., /post/{id}).
     *
     * @param string $method The HTTP request method (GET, POST, etc.)
     * @param string $uri    The request URI path
     * @return mixed         The result of the controller action, or outputs 404 if not found
     */
    public function dispatch(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            // Skip routes that don't match the HTTP method
            if ($route['method'] !== $method) {
                continue;
            }

            // Convert route path to regex, e.g. /post/{id} => /post/([^/]+)
            $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            // Check if the URI matches the route pattern
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove the full match

                // Extract parameter names from the route path
                preg_match_all('#\{([^}]+)\}#', $route['path'], $paramNames);
                $params = [];
                if (!empty($paramNames[1])) {
                    foreach ($paramNames[1] as $index => $name) {
                        $params[$name] = $matches[$index] ?? null;
                    }
                }

                // Split the handler into controller and action
                [$controller, $action] = explode('@', $route['handler']);
                $controllerInstance = new $controller();
                // Call the controller action with extracted parameters
                return call_user_func_array([$controllerInstance, $action], $params);
            }
        }
        // If no route matches, return a 404 response
        http_response_code(404);
        echo "404 Not Found";
    }
}
