<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'StaffAuth::Login');
$routes->post('/do-login', 'StaffAuth::doLogin');
$routes->get('/logout', 'StaffAuth::logout');
$routes->get('/dashboard', 'StaffAuth::index');

