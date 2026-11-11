<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Autentikasi Pengguna
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');

// Halaman Terproteksi Autentikasi Sesi
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Dashboard
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Modul Perangkat Daerah (Instansi)
    $routes->group('perangkat-daerah', static function ($routes) {
        $routes->get('/', 'PerangkatDaerahController::index');
        $routes->get('create', 'PerangkatDaerahController::create');
        $routes->post('store', 'PerangkatDaerahController::store');
        $routes->get('edit/(:num)', 'PerangkatDaerahController::edit/$1');
        $routes->post('update/(:num)', 'PerangkatDaerahController::update/$1');
        $routes->get('delete/(:num)', 'PerangkatDaerahController::delete/$1');
        $routes->post('delete/(:num)', 'PerangkatDaerahController::delete/$1');
    });

    // Modul Pegawai PNS
    $routes->group('pegawai', static function ($routes) {
        $routes->get('/', 'PegawaiController::index');
        $routes->get('create', 'PegawaiController::create');
        $routes->post('store', 'PegawaiController::store');
        $routes->get('edit/(:num)', 'PegawaiController::edit/$1');
        $routes->post('update/(:num)', 'PegawaiController::update/$1');
        $routes->get('delete/(:num)', 'PegawaiController::delete/$1');
        $routes->post('delete/(:num)', 'PegawaiController::delete/$1');
        $routes->get('by-instansi/(:num)', 'PegawaiController::getByInstansi/$1');
    });

    // Modul Kendaraan Dinas Operasional (KDO)
    $routes->group('kendaraan', static function ($routes) {
        $routes->get('/', 'KendaraanController::index');
        $routes->get('detail/(:num)', 'KendaraanController::detail/$1');
        $routes->get('create', 'KendaraanController::create');
        $routes->post('store', 'KendaraanController::store');
        $routes->get('edit/(:num)', 'KendaraanController::edit/$1');
        $routes->post('update/(:num)', 'KendaraanController::update/$1');
        $routes->get('delete/(:num)', 'KendaraanController::delete/$1');
        $routes->post('delete/(:num)', 'KendaraanController::delete/$1');
        $routes->get('filter-data', 'KendaraanController::filterData');
    });

    // Modul Riwayat Pemeliharaan & Servis
    $routes->group('pemeliharaan', static function ($routes) {
        $routes->get('/', 'PemeliharaanController::index');
        $routes->get('create', 'PemeliharaanController::create');
        $routes->post('store', 'PemeliharaanController::store');
        $routes->get('edit/(:num)', 'PemeliharaanController::edit/$1');
        $routes->post('update/(:num)', 'PemeliharaanController::update/$1');
        $routes->get('delete/(:num)', 'PemeliharaanController::delete/$1');
        $routes->post('delete/(:num)', 'PemeliharaanController::delete/$1');
    });
});

// API Public Routes
$routes->group('api', static function ($routes) {
    $routes->get('kendaraan/filter', 'KendaraanController::filterData');
    $routes->get('dashboard/stats', 'DashboardController::apiStats');
});
