<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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