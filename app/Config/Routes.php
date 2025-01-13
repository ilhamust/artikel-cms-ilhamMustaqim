<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//routers admin dashbord
$routes->get('dashboard', 'Admin\DashboardController::index', ['filter' => 'auth']);
$routes->get('login', 'Admin\LoginController::index');
$routes->post('/login', 'Admin\LoginController::authenticate');
$routes->get('/logout', 'Admin\LoginController::logout');
