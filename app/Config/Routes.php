<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('login', 'AuthController::index');
$routes->get('signup', 'AuthController::signup');
