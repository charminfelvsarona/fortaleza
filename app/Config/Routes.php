<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// -------------------- DEFAULT --------------------
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('home', 'Home::index');
$routes->get('login/logout', 'Login::logout');

// -------------------- ADMIN SIDE --------------------

// 🧾 Loan Plan Management
$routes->get('/loan-plans', 'LoanPlanController::index');
$routes->post('/loan-plans/store', 'LoanPlanController::store');
$routes->post('/loan-plans/update/(:num)', 'LoanPlanController::update/$1');
$routes->get('/loan-plans/delete/(:num)', 'LoanPlanController::delete/$1');

// 📊 Loan Type Management
$routes->get('loan-type', 'LoanType::index');
$routes->post('loan-type/save', 'LoanType::save');
$routes->post('loan-type/update/(:num)', 'LoanType::update/$1');
$routes->get('loan-type/delete/(:num)', 'LoanType::delete/$1');

// 💰 Loan Applications (Admin View)
$routes->get('/loans', 'LoanController::index');
$routes->get('/loan/view/(:num)', 'LoanController::view/$1');
$routes->post('/apply-loan', 'LoanController::applyLoan');
$routes->post('/loan/update-status/(:num)', 'LoanController::updateStatus/$1');
$routes->get('admin/view_logs', 'AdminController::viewLogs');


// 🧑‍💼 User Management
$routes->get('user', 'UserController::index');
$routes->post('user/save', 'UserController::add');
$routes->post('user/update/(:num)', 'UserController::update/$1');
$routes->get('user/delete/(:num)', 'UserController::delete/$1');

// 👥 Borrower Management
$routes->get('borrower', 'Borrower::index');
$routes->post('borrower/save', 'Borrower::save');
$routes->post('borrower/update/(:num)', 'Borrower::update/$1');
$routes->get('borrower/delete/(:num)', 'Borrower::delete/$1');

// ⚙️ Admin Control
$routes->post('admin/toggleMode', 'AdminController::toggleMode');

// ------------------- MAINTENANCE --------------------
$routes->get('maintenance', 'MaintenanceController::index');

// ------------------- USER SIDE (Filtered) --------------------
// USER ROUTES with maintenance filter
$routes->group('loanuser', ['filter' => 'maintenance'], function($routes) {
    $routes->get('login', 'LoanUserController::login');
    $routes->post('loginPost', 'LoanUserController::loginPost');
    $routes->get('register', 'LoanUserController::register');
    $routes->post('registerPost', 'LoanUserController::registerPost');
    $routes->get('dashboard', 'LoanUserController::dashboard');
    $routes->get('applyLoan/(:num)', 'LoanUserController::applyLoan/$1');
    $routes->post('saveApplication', 'LoanUserController::saveApplication');
    $routes->post('submitLoan', 'LoanUserController::submitLoan');
    $routes->get('logout', 'LoanUserController::logout');
});
