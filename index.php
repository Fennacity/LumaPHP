<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\App;
use Framework\Framework;
use Framework\Routing\Router;

$routes = require __DIR__ . '/App/routes.php';
$router = new Router($routes);

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo $router->dispatch($method, str_replace('/framework', '', $uri));

$app = new App(new Framework);

// Set error reporting based on environment variables
error_reporting($_ENV['ERROR_REPORTING']);
ini_set('display_errors', $_ENV['DISPLAY_ERRORS']);
ini_set('display_startup_errors', $_ENV['DISPLAY_STARTUP_ERRORS']);