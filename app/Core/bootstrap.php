<?php
declare(strict_types=1);

// --- Load .env -------------------------------------------------------------
$envFile = BASE_PATH . '/.env';
if (is_file($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$k, $v] = array_map('trim', explode('=', $line, 2));
        $v = trim($v, "\"'");
        $_ENV[$k] = $v;
        putenv("$k=$v");
    }
}

// --- Errors ----------------------------------------------------------------
$debug = filter_var($_ENV['APP_DEBUG'] ?? 'false', FILTER_VALIDATE_BOOLEAN);
ini_set('display_errors', $debug ? '1' : '0');
error_reporting($debug ? E_ALL : 0);
date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'UTC');

// --- Autoloader (PSR-4: App\ => app/) -------------------------------------
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) return;
    $relative = substr($class, strlen($prefix));
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) require $file;
});

// --- Helpers ---------------------------------------------------------------
require BASE_PATH . '/app/Helpers/functions.php';
require BASE_PATH . '/app/Helpers/dates.php';
require BASE_PATH . '/app/Helpers/mock_data.php';

// --- Session ---------------------------------------------------------------
App\Core\Session::start();

// --- FRONTEND-ONLY MODE ----------------------------------------------------
// Mock users per role. Switch via `?role=admin|doctor|staff|patient` in the
// URL (persisted in session). Remove later when real auth is wired up.
$mockUsers = [
    'admin' => [
        'id' => 1, 'name' => 'Demo Admin', 'email' => 'admin@clinic.local',
        'role' => 'admin', 'phone' => '+63 900 000 0000',
    ],
    'doctor' => [
        'id' => 2, 'name' => 'Jane Cruz', 'email' => 'jane@clinic.local',
        'role' => 'doctor', 'phone' => '+63 917 100 1001', 'specialty' => 'Orthodontics',
    ],
    'staff' => [
        'id' => 3, 'name' => 'Rosa Lim', 'email' => 'rosa@clinic.local',
        'role' => 'staff', 'phone' => '+63 917 200 2001', 'position' => 'Receptionist',
    ],
    'patient' => [
        'id' => 4, 'name' => 'Maria Santos', 'email' => 'maria@example.com',
        'role' => 'patient', 'phone' => '+63 917 111 1111',
    ],
];

// Allow URL ?role=... to switch the active mock user.
$requestedRole = $_GET['role'] ?? null;
if ($requestedRole && isset($mockUsers[$requestedRole])) {
    App\Core\Auth::login($mockUsers[$requestedRole]);
} elseif (!App\Core\Auth::check()) {
    App\Core\Auth::login($mockUsers['admin']);
}
