<?php
declare(strict_types=1);

namespace App\Core;

class Csrf
{
    public static function token(): string
    {
        if (!Session::has('_csrf')) {
            Session::set('_csrf', bin2hex(random_bytes(32)));
        }
        return Session::get('_csrf');
    }

    public static function check(?string $token): bool
    {
        return is_string($token) && hash_equals((string) Session::get('_csrf'), $token);
    }

    public static function field(): string
    {
        return '<input type="hidden" name="_token" value="' . self::token() . '">';
    }
}
