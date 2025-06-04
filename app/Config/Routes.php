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
$routes->group('staff', ['filter' => 'staff_auth'], function($routes) {
    $routes->get('dashboard', 'Staff\Dashboard::index');
    
    $routes->group('book-categories', ['namespace' => 'App\Controllers\Staff'], function($routes) {
        $routes->get('/', 'BookCategories::index');
        $routes->get('create', 'BookCategories::create');
        $routes->post('store', 'BookCategories::store');
        $routes->get('edit/(:num)', 'BookCategories::edit/$1');
        $routes->post('delete/(:num)', 'BookCategories::delete/$1');
    });
    

        $routes->group('book', function($routes) {
            $routes->get('/', 'Staff\Book::index');
        });
        $routes->group('loan', function($routes) {
            $routes->get('/', 'Staff\Loan::index');
        });
        $routes->group('member', function($routes) {
            $routes->get('/', 'Staff\Member::index');
        });
    });