<?php
/**
 * @var App\Core\Router $router
 */

use App\Controllers\AuthController;
use App\Controllers\LandingController;
use App\Controllers\DashboardController;
use App\Controllers\PatientController;
use App\Controllers\AppointmentController;
use App\Controllers\DentistController;
use App\Controllers\StaffController;
use App\Controllers\TreatmentController;
use App\Controllers\DentalChartController;
use App\Controllers\BillingController;
use App\Controllers\InventoryController;
use App\Controllers\ServiceController;
use App\Controllers\ReportController;
use App\Controllers\SettingsController;
use App\Controllers\ProfileController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;

// -----------------------------------------------------------------------
// Public routes (no auth required)
// -----------------------------------------------------------------------
$router->get('/',         [LandingController::class, 'index']);
$router->get('/login',    [AuthController::class, 'showLogin']);
$router->get('/register', [AuthController::class, 'showRegister']);

$router->post('/login',   [AuthController::class, 'login'],  [CsrfMiddleware::class]);
$router->post('/logout',  [AuthController::class, 'logout'], [CsrfMiddleware::class]);

// -----------------------------------------------------------------------
// Authenticated routes
// -----------------------------------------------------------------------
$auth = [AuthMiddleware::class];

$router->get('/dashboard', [DashboardController::class, 'index'], $auth);

// Patients
$router->get('/patients',                       [PatientController::class, 'index'],  $auth);
$router->get('/patients/create',                [PatientController::class, 'create'], $auth);
$router->get('/patients/{id}',                  [PatientController::class, 'show'],   $auth);
$router->get('/patients/{id}/edit',             [PatientController::class, 'edit'],   $auth);
$router->get('/patients/{id}/dental-chart',     [DentalChartController::class, 'show'], $auth);

// Appointments
$router->get('/appointments',           [AppointmentController::class, 'index'],  $auth);
$router->get('/appointments/create',    [AppointmentController::class, 'create'], $auth);
$router->get('/appointments/{id}',      [AppointmentController::class, 'show'],   $auth);
$router->get('/appointments/{id}/edit', [AppointmentController::class, 'edit'],   $auth);

// Dentists / Staff
$router->get('/dentists',        [DentistController::class, 'index'],  $auth);
$router->get('/dentists/create', [DentistController::class, 'create'], $auth);
$router->get('/staff',           [StaffController::class, 'index'],    $auth);
$router->get('/staff/create',    [StaffController::class, 'create'],   $auth);

// Treatments / Services
$router->get('/treatments', [TreatmentController::class, 'index'], $auth);
$router->get('/services',   [ServiceController::class, 'index'],   $auth);

// Billing
$router->get('/billing',      [BillingController::class, 'index'], $auth);
$router->get('/billing/{id}', [BillingController::class, 'show'],  $auth);

// Inventory / Reports / Settings / Profile
$router->get('/inventory', [InventoryController::class, 'index'], $auth);
$router->get('/reports',   [ReportController::class, 'index'],    $auth);
$router->get('/settings',  [SettingsController::class, 'index'],  $auth);
$router->get('/profile',   [ProfileController::class, 'edit'],    $auth);
