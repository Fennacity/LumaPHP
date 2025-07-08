<?php

use Framework\Routing\Routes;

$routes = new Routes();

// Define routes
$routes->addRoute('GET', '/', 'App\Controllers\HomeController@index');