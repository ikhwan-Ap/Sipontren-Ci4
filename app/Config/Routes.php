<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/login/admin', 'Login::admin');
$routes->get('/login/asatidz', 'Login::asatidz');
$routes->get('/login/santri', 'Login::santri');


// register
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');
$routes->get('/register/santri', 'Register::santri', ['filter' => 'isRegister']);

// pendaftaran santri baru
$routes->delete('/pendaftaran/(:num)', 'Pendaftaran::delete/$1');

// dashboard admin / super admin
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedIn']);
$routes->get('/dashboard/asatidz', 'Dashboard::asatidz', ['filter' => 'isLoggedIn']);
$routes->get('/dashboard/santri', 'Dashboard::santri', ['filter' => 'isLoggedIn']);
$routes->get('/dashboard/coba', 'Santri::coba');

// admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/add', 'Admin::create');
$routes->post('/admin', 'Admin::save');
$routes->delete('/admin/(:num)', 'Admin::delete/$1');
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1');
$routes->put('/admin/(:any)', 'Admin::update/$1');
$routes->get('/admin/detail/(:num)', 'Admin::detail/$1');

// pendaftaran baru
$routes->get('/pendaftaran', 'Pendaftaran::index');


// asatidz

$routes->get('/asatidz', 'Asatidz::index');
$routes->get('/asatidz/profil/(:num)', 'Asatidz::profil/$1');
$routes->get('/asatidz/layout', 'Asatidz::template');

// santri
$routes->get('/santri', 'Santri::index');

$routes->get('/santri/add', 'Santri::create');
$routes->post('/santri', 'Santri::save');
$routes->get('/santri/edit/(:any)', 'Santri::edit/$1');
$routes->put('/santri/(:num)', 'Santri::update/$1');
$routes->get('/santri/profil/(:num)', 'Santri::profil/$1');
$routes->get('/santri/biodata', 'Santri::biodata');
$routes->get('/santri/detail/(:num)', 'Santri::detail/$1');

// alumni
$routes->get('/alumni', 'Alumni::index');


// diniyah
$routes->get('/diniyah', 'Diniyah::index');
$routes->get('/diniyah/add', 'Diniyah::create');
$routes->post('/diniyah', 'Diniyah::save');
$routes->delete('/diniyah/(:num)', 'Diniyah::delete/$1');
$routes->get('/diniyah/edit/(:any)', 'Diniyah::edit/$1');
$routes->put('/diniyah/(:any)', 'Diniyah::update/$1');

// program
$routes->get('/program', 'Program::index');
$routes->get('/program/add', 'Program::create');
$routes->post('/program', 'Program::save');
$routes->delete('/program/(:num)', 'Program::delete/$1');
$routes->get('/program/edit/(:any)', 'Program::edit/$1');
$routes->put('/program/(:any)', 'Program::update/$1');

// kamar
$routes->get('/kamar', 'Kamar::index');
$routes->get('/kamar/add', 'Kamar::create');
$routes->post('/kamar', 'Kamar::save');
$routes->delete('/kamar/(:num)', 'Kamar::delete/$1');
$routes->get('/kamar/edit/(:any)', 'Kamar::edit/$1');
$routes->put('/kamar/(:any)', 'Kamar::update/$1');

// kelas
$routes->get('/kelas', 'Kelas::index');
$routes->get('/kelas/add', 'Kelas::create');
$routes->post('/kelas', 'Kelas::save');
$routes->delete('/kelas/(:num)', 'Kelas::delete/$1');
$routes->get('/kelas/edit/(:any)', 'Kelas::edit/$1');
$routes->put('/kelas/(:any)', 'Kelas::update/$1');

// gedung
$routes->get('/gedung', 'Gedung::index');
$routes->get('/gedung/add', 'Gedung::create');
$routes->post('/gedung', 'gedung::save');
$routes->delete('/gedung/(:num)', 'Gedung::delete/$1');
$routes->get('/gedung/edit/(:any)', 'Gedung::edit/$1');
$routes->put('/gedung/(:any)', 'Gedung::update/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
