<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * Routes untuk Sistem Perpustakaan
 */

// =============================================
// PUBLIC ROUTES (gak perlu login)
// =============================================
$routes->get('/', 'Home::index');

// =============================================
// STAFF AUTHENTICATION ROUTES
// =============================================
$routes->group('staff', function($routes) {
    $routes->get('login', 'StaffAuth::login');
    $routes->post('login', 'StaffAuth::doLogin');
    $routes->get('logout', 'StaffAuth::logout');
});

// =============================================
// STAFF DASHBOARD ROUTES (Perlu login staff)
// =============================================
$routes->group('staff/dashboard', ['filter' => 'staff_auth'], function($routes) {
    $routes->get('/', 'Staff\Dashboard::index');
    
    $routes->group('members', function($routes) {
        $routes->get('/', 'Staff\Members::index');
        $routes->get('create', 'Staff\Members::create');
        $routes->post('store', 'Staff\Members::store');
        $routes->get('show/(:num)', 'Staff\Members::show/$1');
        $routes->get('edit/(:num)', 'Staff\Members::edit/$1');
        $routes->post('update/(:num)', 'Staff\Members::update/$1');
        $routes->delete('delete/(:num)', 'Staff\Members::delete/$1');
        $routes->get('search', 'Staff\Members::search');
        $routes->post('suspend/(:num)', 'Staff\Members::suspend/$1');
        $routes->post('activate/(:num)', 'Staff\Members::activate/$1');
    });
    
    // Book Management
    $routes->group('books', function($routes) {
        $routes->get('/', 'Staff\Books::index');
        $routes->get('create', 'Staff\Books::create');
        $routes->post('store', 'Staff\Books::store');
        $routes->get('show/(:num)', 'Staff\Books::show/$1');
        $routes->get('edit/(:num)', 'Staff\Books::edit/$1');
        $routes->post('update/(:num)', 'Staff\Books::update/$1');
        $routes->delete('delete/(:num)', 'Staff\Books::delete/$1');
        $routes->get('search', 'Staff\Books::search');
        
        // Book Categories
        $routes->group('categories', function($routes) {
            $routes->get('/', 'Staff\BookCategories::index');
            $routes->get('create', 'Staff\BookCategories::create');
            $routes->post('store', 'Staff\BookCategories::store');
            $routes->get('edit/(:num)', 'Staff\BookCategories::edit/$1');
            $routes->post('update/(:num)', 'Staff\BookCategories::update/$1');
            $routes->delete('delete/(:num)', 'Staff\BookCategories::delete/$1');
        });
    });
});