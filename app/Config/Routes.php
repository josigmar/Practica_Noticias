<?php
use CodeIgniter\Router\RouteCollection;
use App\Controllers\News;
use App\Controllers\Users;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [News::class, 'index']);

//Muestra el formulario de inicio de sesión:
$routes->get('admin', [Users::class, 'loginForm']);

//Obtenemos user y pass:
$routes->post('login', [Users::class, 'checkUser']);

//Cerramos sesión:
$routes->get('session', [Users::class, 'closeSession']);

$routes->get('/(:segment)', [News::class, 'index']);

$routes->get('news/(:segment)', [News::class, 'show']);