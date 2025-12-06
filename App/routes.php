<?php
use Luma\Routing\Routes;

$routes = new Routes();

/* Define routes
* Method, Path, Handler, In Navigation, Title
* Example: $routes->addRoute('GET', '/posts', 'App\Controllers\PostController@index', true, 'Posts');
*/

$routes->addRoute('GET', '/', 'App\Controllers\HomeController@index', true, 'Home');
$routes->addRoute('GET', '/about', 'App\Controllers\AboutController@index', true, 'About');

return $routes;