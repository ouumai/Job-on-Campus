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

# -- SHIELD ACTION ROUTES (Email Activation, etc) --
$routes->get('auth/a/show', '\CodeIgniter\Shield\Controllers\ActionController::show', ['as' => 'auth-action-show']);
$routes->post('auth/a/handle', '\CodeIgniter\Shield\Controllers\ActionController::handle', ['as' => 'auth-action-handle']);
$routes->post('auth/a/verify', '\CodeIgniter\Shield\Controllers\ActionController::verify', ['as' => 'auth-action-verify']);
