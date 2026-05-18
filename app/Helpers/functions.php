<?php
declare(strict_types=1);

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;

if (!function_exists('e')) {
    function e($value): string {
        return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('url')) {
    function url(string $path = '/'): string {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        $rel  = ltrim($path, '/');
        $full = BASE_PATH . '/public/assets/' . $rel;
        $url  = url('assets/' . $rel);
        // Append filemtime as cache-buster so browsers always pick up the
        // latest compiled CSS/JS after a rebuild.
        if (is_file($full)) {
            $url .= (str_contains($url, '?') ? '&' : '?') . 'v=' . filemtime($full);
        }
        return $url;
    }
}

if (!function_exists('old')) {
    function old(string $key, $default = '') {
        $old = Session::flash('_old') ?? $_SESSION['_old'] ?? [];
        return $old[$key] ?? $default;
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string { return Csrf::field(); }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string { return Csrf::token(); }
}

if (!function_exists('auth')) {
    function auth(): ?array { return Auth::user(); }
}

if (!function_exists('config')) {
    function config(string $key, $default = null) {
        static $cache = [];
        [$file, $rest] = array_pad(explode('.', $key, 2), 2, null);
        if (!isset($cache[$file])) {
            $path = BASE_PATH . "/config/{$file}.php";
            $cache[$file] = is_file($path) ? require $path : [];
        }
        if ($rest === null) return $cache[$file];
        return $cache[$file][$rest] ?? $default;
    }
}

if (!function_exists('icon')) {
    /** Render a Heroicon by name. */
    function icon(string $name, string $class = 'h-5 w-5'): void {
        \App\Core\View::partial('icon', ['name' => $name, 'class' => $class]);
    }
}

if (!function_exists('dd')) {
    function dd(...$vars): void {
        echo '<pre style="background:#0f172a;color:#e2e8f0;padding:1rem;border-radius:8px">';
        foreach ($vars as $v) { var_dump($v); }
        echo '</pre>';
        exit;
    }
}
