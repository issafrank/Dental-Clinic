<?php
declare(strict_types=1);

if (!function_exists('format_date')) {
    function format_date(?string $date, string $format = 'M d, Y'): string {
        if (!$date) return '';
        $ts = strtotime($date);
        return $ts ? date($format, $ts) : '';
    }
}

if (!function_exists('format_datetime')) {
    function format_datetime(?string $date, string $format = 'M d, Y h:i A'): string {
        if (!$date) return '';
        $ts = strtotime($date);
        return $ts ? date($format, $ts) : '';
    }
}

if (!function_exists('age_from')) {
    function age_from(?string $birthdate): ?int {
        if (!$birthdate) return null;
        try {
            return (new DateTime($birthdate))->diff(new DateTime('today'))->y;
        } catch (Throwable) { return null; }
    }
}
