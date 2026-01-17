<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\News;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [News::class, 'index']);
$routes->get('/(:segment)', [News::class, 'index']);
$routes->get('news/(:segment)', [News::class, 'show']);