<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('lang', 'Language::index');

# -- AUTHENTICATION --
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::loginAction');

$routes->get('signup', 'AuthController::signup');
$routes->post('signup', 'AuthController::registerAction');
$routes->get('verify-token', 'AuthController::showVerifyTokenPage');
$routes->post('verify-token', 'AuthController::verifyToken');
$routes->post('resend-otp', 'AuthController::resendOtp');

# -- SHIELD ACTION ROUTES (Email Activation, etc) --
$routes->get('auth/a/show', '\CodeIgniter\Shield\Controllers\ActionController::show', ['as' => 'auth-action-show']);
$routes->post('auth/a/handle', '\CodeIgniter\Shield\Controllers\ActionController::handle', ['as' => 'auth-action-handle']);
$routes->post('auth/a/verify', '\CodeIgniter\Shield\Controllers\ActionController::verify', ['as' => 'auth-action-verify']);
