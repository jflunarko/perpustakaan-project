<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * Routes untuk Sistem Perpustakaan
 */

// =============================================
// PUBLIC ROUTES (gak perlu login)
// =============================================
$routes->get('/', 'Public\Library::index');
$routes->get('home', 'Public\Library::index');
$routes->get('catalog', 'Public\Library::catalog');
$routes->get('about', 'Public\Library::about');
$routes->get('contact', 'Public\Library::contact');

// =============================================
// LOAN ROUTES (Public bisa akses, tapi cek login di controller)
// =============================================
$routes->get('/catalog', 'Public\Catalog::index');

// Route untuk buku yang sedang dipinjam oleh member
$routes->get('/catalog/borrowed', 'Public\Catalog::myBorrowedBooks');

// Route untuk proses peminjaman (yang sudah ada)
$routes->get('/loan/borrow/(:num)', 'Public\Loan::borrow/$1');
$routes->post('/loan/process', 'Public\Loan::processLoan');
$routes->post('/loan/return', 'Public\Loan::returnBook');

// Route untuk riwayat peminjaman
$routes->get('/member/loans', 'Public\Loan::myLoans');


// =============================================
// MEMBER AUTHENTICATION ROUTES  
// =============================================
$routes->group('member', function($routes) {
    $routes->get('login', 'Member\MemberAuth::login');
    $routes->post('login', 'Member\MemberAuth::doLogin');
    $routes->get('logout', 'Member\MemberAuth::logout');
});

// =============================================
// STAFF AUTHENTICATION ROUTES
// =============================================
$routes->group('staff', function($routes) {
    $routes->get('login', 'Staff\StaffAuth::login');
    $routes->post('login', 'Staff\StaffAuth::doLogin');
    $routes->get('logout', 'Staff\StaffAuth::logout');
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
    
    $routes->group('book', ['namespace' => 'App\Controllers\Staff'], function($routes) {
        $routes->get('/', 'Book::index');
        $routes->get('create', 'Book::create');
        $routes->post('store', 'Book::store');
        $routes->get('edit/(:num)', 'Book::edit/$1');
        $routes->post('update/(:num)', 'Book::update/$1');
        $routes->post('delete/(:num)', 'Book::delete/$1');
    });
    
    // Group untuk Staff Loan Routes
    $routes->group('loan', ['namespace' => 'App\Controllers\Staff'], function($routes) {
        $routes->get('/', 'Loan::index');
        $routes->get('create', 'Loan::create');
        $routes->post('store', 'Loan::store');
        $routes->get('edit/(:num)', 'Loan::edit/$1');
        $routes->post('delete/(:num)', 'Loan::delete/$1');
    });
    
    // Group untuk Staff Member Routes
    $routes->group('member', ['namespace' => 'App\Controllers\Staff'], function($routes) {
        $routes->get('/', 'Member::index');
        $routes->get('create', 'Member::create');
        $routes->post('store', 'Member::store');
        $routes->get('edit/(:num)', 'Member::edit/$1');
        $routes->post('delete/(:num)', 'Member::delete/$1');
    });
    

});