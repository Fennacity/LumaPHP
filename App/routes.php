<?php
use Luma\Routing\Routes;

$routes = new Routes();

/* Define routes here.
 *
 * Parameters:
 * - HTTP Method (e.g., 'GET', 'POST')
 * - URI Path (e.g., '/about', '/posts/{id}')
 * - Handler (e.g., 'App\Controllers\AboutController@index')
 * - Title (string) - The title for the route (used in navigation)
 * - In Navigation (bool) - Whether to include this route in navigation
 *
*/

$routes->addRoute('GET', '/', 'App\Controllers\HomeController@index', 'Home', true);
$routes->addRoute('GET', '/about', 'App\Controllers\AboutController@index', 'About', true);

return $routes;