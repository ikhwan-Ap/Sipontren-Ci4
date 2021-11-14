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

// dashboard admin / super admin
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedIn']);

// admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/add', 'Admin::create');
$routes->post('/admin', 'Admin::save');
$routes->delete('/admin/(:num)', 'Admin::delete/$1');
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1');
$routes->put('/admin/(:any)', 'Admin::update/$1');
$routes->get('/admin/detail/(:num)', 'Admin::detail/$1');

// asatidz

$routes->get('/asatidz', 'asatidz::index');

// program
$routes->get('/program', 'Program::index');
$routes->get('/program/add', 'Program::create');
$routes->post('/program', 'Program::save');
$routes->delete('/program/(:num)', 'Program::delete/$1');
$routes->get('/program/edit/(:any)', 'Program::edit/$1');
$routes->put('/program/(:any)', 'Program::update/$1');

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
