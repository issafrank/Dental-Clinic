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

