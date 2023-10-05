<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::home');
$routes->get('login', 'Home::masuk');
$routes->get('daftar', 'Home::daftar');
$routes->get('registration', 'Registration::index');
$routes->post('/user/save', 'Home::save');

