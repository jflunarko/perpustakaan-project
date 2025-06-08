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