<?php
use CodeIgniter\Router\RouteCollection;
use App\Controllers\News;
use App\Controllers\NewsBackend;
use App\Controllers\Users;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [News::class, 'index']);

$routes->get('category/(:segment)', [News::class, 'index']);

$routes->get('news/(:segment)', [News::class, 'show']);

//Muestra el formulario de inicio de sesión:
$routes->get('admin', [Users::class, 'loginForm']);

//Obtenemos user y pass:
$routes->post('login', [Users::class, 'checkUser']);

//Cerramos sesión:
$routes->get('session', [Users::class, 'closeSession']);

/*
Para las rutas del backend (o cualquier otro) CI4 nos permite agruparlas

Los grupos permiten no tener que escribir en cada ruta backend/...algo...

Cada ruta dentro del grupo será como si empezase por backend/ (vamos son un prefijo)
*/
$routes->group('backend', function($routes){
    $routes->get('', [NewsBackend::class, 'index']);
    $routes->get('news/(:segment)', [NewsBackend::class, 'show']);
});