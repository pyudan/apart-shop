<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Controller::loginView');
$routes->get('loginView', 'Controller::loginView');
$routes->match(['get', 'post'], 'login', 'Controller::login');
$routes->get('logout', 'Controller::logout');
$routes->post('saleInsert/(:num)', 'Controller::saleInsert/$1');
$routes->get('saleSelect', 'Controller::saleSelect');
$routes->get('provinceSelect', 'Controller::provinceSelect');
$routes->post('provinceInsert', 'Controller::provinceInsert');
$routes->post('provinceUpdate/(:num)', 'Controller::provinceUpdate/$1');
$routes->get('provinceDelete/(:num)', 'Controller::provinceDelete/$1');
$routes->get('officeSelect', 'Controller::officeSelect');
$routes->post('officeInsert', 'Controller::officeInsert');
$routes->post('officeUpdate/(:num)', 'Controller::officeUpdate/$1');
$routes->get('officeDelete/(:num)', 'Controller::officeDelete/$1');
$routes->get('siteSelect', 'Controller::siteSelect');
$routes->post('siteInsert', 'Controller::siteInsert');
$routes->post('siteUpdate/(:num)', 'Controller::siteUpdate/$1');
$routes->get('siteDelete/(:num)', 'Controller::siteDelete/$1');
$routes->get('apartSelect', 'Controller::apartSelect', ['filter' => 'authGuard']);
$routes->post('apartInsert', 'Controller::apartInsert');
$routes->post('apartUpdate/(:num)', 'Controller::apartUpdate/$1');
$routes->get('apartDelete/(:num)', 'Controller::apartDelete/$1');
$routes->get('custSelect', 'Controller::custSelect');
$routes->post('custInsert', 'Controller::custInsert');
$routes->post('custQuiInsert', 'Controller::custQuiInsert');
$routes->post('custUpdate/(:num)', 'Controller::custUpdate/$1');
$routes->get('custDelete/(:num)', 'Controller::custDelete/$1');
$routes->get('officerSelect', 'Controller::officerSelect');
$routes->match(['get', 'post'], 'officerInsert', 'Controller::officerInsert');
$routes->post('officerUpdate/(:num)', 'Controller::officerUpdate/$1');
$routes->post('officerAccUpdate/(:num)', 'Controller::officerAccUpdate/$1');
$routes->get('officerDelete/(:num)', 'Controller::officerDelete/$1');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
