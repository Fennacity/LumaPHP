<?php

use Framework\Routing\Routes;

$routes = new Routes();

// Define routes
$routes->addRoute('GET', '/', 'App\Controllers\HomeController@index');
$routes->addRoute('GET', '/post', 'App\Controllers\PostController@index');
$routes->addRoute('GET', '/test', 'App\Controllers\TestController@index');

return $routes;