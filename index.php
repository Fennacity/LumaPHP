<?php
// Autoload Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set error reporting based on environment variables (move to top)
error_reporting($_ENV['ERROR_REPORTING']);
ini_set('display_errors', $_ENV['DISPLAY_ERRORS']);
ini_set('display_startup_errors', $_ENV['DISPLAY_STARTUP_ERRORS']);

// Import necessary classes
use Luma\Routing\Router;
use Luma\Templating\Template;

// Get the base path from environment variables (used for routing and URLs)
$basePath = '/' . $_ENV['BASE_PATH'] ?? '';

// Load route definitions
$routes = require __DIR__ . '/App/routes.php';

// Create a new Router instance with the loaded routes
$router = new Router($routes);

// Add routes to template AFTER router is created
Template::addRoutesToTemplate($routes->getRoutes());

// Get the HTTP request method and URI path
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the base path from the URI if present, so routing works correctly
if ($basePath && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
    if ($uri === '') $uri = '/';
}

// Dispatch the request to the appropriate controller/action and output the response
echo $router->dispatch($method, $uri);