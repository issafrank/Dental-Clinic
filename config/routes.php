<?php
/**
 * FRONTEND-ONLY ROUTES.
 * No middleware, no auth, no DB. Mock data lang.
 *
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

// Public landing page
$router->get('/',          [LandingController::class, 'index']);
$router->get('/dashboard', [DashboardController::class, 'index']);

// Auth (UI only; logout just redirects home)
$router->get('/login',     [AuthController::class, 'showLogin']);
$router->get('/register',  [AuthController::class, 'showRegister']);
$router->post('/logout',   [AuthController::class, 'logout']);

// Patients
$router->get('/patients',           [PatientController::class, 'index']);
$router->get('/patients/create',    [PatientController::class, 'create']);
$router->get('/patients/{id}',      [PatientController::class, 'show']);
$router->get('/patients/{id}/edit', [PatientController::class, 'edit']);
$router->get('/patients/{id}/dental-chart', [DentalChartController::class, 'show']);

// Appointments
$router->get('/appointments',           [AppointmentController::class, 'index']);
$router->get('/appointments/create',    [AppointmentController::class, 'create']);
$router->get('/appointments/{id}',      [AppointmentController::class, 'show']);
$router->get('/appointments/{id}/edit', [AppointmentController::class, 'edit']);

// Dentists / Staff
$router->get('/dentists',        [DentistController::class, 'index']);
$router->get('/dentists/create', [DentistController::class, 'create']);
$router->get('/staff',           [StaffController::class, 'index']);
$router->get('/staff/create',    [StaffController::class, 'create']);

// Treatments / Services
$router->get('/treatments',      [TreatmentController::class, 'index']);
$router->get('/services',        [ServiceController::class, 'index']);

// Billing
$router->get('/billing',         [BillingController::class, 'index']);
$router->get('/billing/{id}',    [BillingController::class, 'show']);

// Inventory / Reports / Settings / Profile
$router->get('/inventory',       [InventoryController::class, 'index']);
$router->get('/reports',         [ReportController::class, 'index']);
$router->get('/settings',        [SettingsController::class, 'index']);
$router->get('/profile',         [ProfileController::class, 'edit']);
