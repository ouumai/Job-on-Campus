<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

# -- AUTHENTICATION --
$routes->get('login', 'AuthController::index');

$routes->get('signup', 'AuthController::signup');
$routes->post('signup', 'AuthController::registerAction');
